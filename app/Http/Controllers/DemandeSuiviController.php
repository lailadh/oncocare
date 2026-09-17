<?php

namespace App\Http\Controllers;

use App\Models\DemandeSuivi;
use App\Models\Medecin;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DemandeSuiviController extends Controller
{
    /**
     * Recherche des médecins actifs côté patient.
     *
     * Le patient peut rechercher un médecin par nom ou
     * spécialité et consulter son profil avant d'envoyer
     * une demande de suivi.
     */
    public function medecinsIndex(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $search = trim($request->query('q', ''));

        $medecins = Medecin::whereHas(
            'utilisateur',
            function ($query): void {
                $query
                    ->where('role', 'medecin')
                    ->where('statut', 'active');
            }
        )
            ->with('utilisateur')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('specialite', 'like', "%{$search}%")
                        ->orWhereHas('utilisateur', function ($query) use ($search): void {
                            $query->where('nom', 'like', "%{$search}%")
                                ->orWhere('prenom', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('id_medecin')
            ->get();

        $associesIds = $user->patient
            ->medecins()
            ->pluck('medecins.id_medecin')
            ->all();

        return view(
            'patient.medecins.index',
            compact('medecins', 'associesIds', 'search')
        );
    }

    /**
     * Détail d'un médecin actif côté patient.
     */
    public function medecinShow(Medecin $medecin)
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        if (
            !$medecin->utilisateur ||
            $medecin->utilisateur->role !== 'medecin' ||
            $medecin->utilisateur->statut !== 'active'
        ) {
            abort(404);
        }

        $medecin->load('utilisateur');

        $estAssocie = $user->patient
            ->medecins()
            ->where('medecins.id_medecin', $medecin->id_medecin)
            ->exists();

        $demandeEnAttente = DemandeSuivi::where(
            'id_patient',
            $user->patient->id_patient
        )
            ->where(
                'id_medecin',
                $medecin->id_medecin
            )
            ->where('statut', 'en_attente')
            ->exists();

        return view(
            'patient.medecins.show',
            compact('medecin', 'estAssocie', 'demandeEnAttente')
        );
    }

    /**
     * Liste des demandes de suivi du patient connecté.
     */
    public function patientIndex()
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $demandes = $user->patient
            ->demandesSuivi()
            ->with('medecin.utilisateur')
            ->latest()
            ->get();

        return view(
            'patient.demandes_suivi.index',
            compact('demandes')
        );
    }

    /**
     * Créer une demande de suivi côté patient.
     *
     * Vérifications serveur :
     * - le médecin existe et est actif ;
     * - le patient n'est pas déjà suivi par ce médecin ;
     * - aucune demande en attente n'existe déjà.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', DemandeSuivi::class);

        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $validated = $request->validate([
            'id_medecin' => [
                'required',
                'exists:medecins,id_medecin',
            ],
        ], [
            'id_medecin.required' => 'Veuillez sélectionner un médecin.',
            'id_medecin.exists' => 'Le médecin sélectionné est invalide.',
        ]);

        $medecin = Medecin::with('utilisateur')
            ->findOrFail($validated['id_medecin']);

        if (
            !$medecin->utilisateur ||
            $medecin->utilisateur->role !== 'medecin' ||
            $medecin->utilisateur->statut !== 'active'
        ) {
            return back()->withErrors([
                'id_medecin' => 'Ce médecin n’est pas actuellement disponible.',
            ]);
        }

        if (
            $user->patient
                ->medecins()
                ->where('medecins.id_medecin', $medecin->id_medecin)
                ->exists()
        ) {
            return back()->withErrors([
                'id_medecin' => 'Vous êtes déjà suivi par ce médecin.',
            ]);
        }

        $demandeExiste = DemandeSuivi::where(
            'id_patient',
            $user->patient->id_patient
        )
            ->where(
                'id_medecin',
                $medecin->id_medecin
            )
            ->where('statut', 'en_attente')
            ->exists();

        if ($demandeExiste) {
            return back()->withErrors([
                'id_medecin' => 'Vous avez déjà une demande de suivi en attente avec ce médecin.',
            ]);
        }

        DemandeSuivi::create([
            'statut' => 'en_attente',
            'date_demande' => now()->toDateString(),
            'id_patient' => $user->patient->id_patient,
            'id_medecin' => $medecin->id_medecin,
        ]);

        // Notification au médecin.
        Notification::create([
            'titre' => 'Nouvelle demande de suivi',
            'type' => 'demande_suivi',
            'message' => $user->prenom . ' ' .
                $user->nom .
                ' vous a envoyé une demande de suivi. ' .
                'Vous pouvez l’accepter ou la refuser depuis votre espace.',
            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $medecin->utilisateur->id,
        ]);

        return redirect()
            ->route('patient.demandes-suivi.index')
            ->with(
                'success',
                'Votre demande de suivi a été envoyée à Dr ' .
                $medecin->utilisateur->prenom . ' ' .
                $medecin->utilisateur->nom .
                '.'
            );
    }

    /**
     * Liste des demandes de suivi reçues par le médecin connecté.
     */
    public function medecinIndex()
    {
        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        $demandes = $user->medecin
            ->demandesSuivi()
            ->with('patient.utilisateur')
            ->latest()
            ->get();

        return view(
            'medecin.demandes_suivi.index',
            compact('demandes')
        );
    }

    /**
     * Accepter une demande de suivi.
     *
     * Si la demande est acceptée, le lien de suivi
     * (table "suivre") est créé entre le patient et le médecin.
     */
    public function accepter(DemandeSuivi $demandeSuivi)
    {
        Gate::authorize('update', $demandeSuivi);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        if ($demandeSuivi->statut !== 'en_attente') {
            return redirect()
                ->route('medecin.demandes-suivi.index')
                ->withErrors([
                    'demandeSuivi' => 'Cette demande de suivi a déjà été traitée.',
                ]);
        }

        if ($demandeSuivi->id_medecin !== $user->medecin->id_medecin) {
            abort(403);
        }

        $demandeSuivi->load('patient.utilisateur');

        DB::transaction(function () use ($demandeSuivi, $user): void {

            // Marquée comme acceptée.
            $demandeSuivi->update([
                'statut' => 'acceptee',
                'date_traitement' => now(),
            ]);

            // Création du lien de suivi (table "suivre").
            $demandeSuivi->patient()
                ->first()
                ->medecins()
                ->syncWithoutDetaching(
                    $user->medecin->id_medecin
                );

            // Notification au patient.
            Notification::create([
                'titre' => 'Demande de suivi acceptée',
                'type' => 'demande_suivi',
                'message' => 'Le Dr ' .
                    $user->prenom . ' ' .
                    $user->nom .
                    ' a accepté votre demande de suivi.',
                'lu' => false,
                'date_notification' => now(),
                'id_utilisateur' => $demandeSuivi->patient->id_utilisateur,
            ]);
        });

        return redirect()
            ->route('medecin.demandes-suivi.index')
            ->with(
                'success',
                'La demande de suivi a été acceptée. Le patient a été notifié et le lien de suivi est créé.'
            );
    }

    /**
     * Refuser une demande de suivi.
     */
    public function refuser(DemandeSuivi $demandeSuivi)
    {
        Gate::authorize('update', $demandeSuivi);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        if ($demandeSuivi->statut !== 'en_attente') {
            return redirect()
                ->route('medecin.demandes-suivi.index')
                ->withErrors([
                    'demandeSuivi' => 'Cette demande de suivi a déjà été traitée.',
                ]);
        }

        if ($demandeSuivi->id_medecin !== $user->medecin->id_medecin) {
            abort(403);
        }

        $demandeSuivi->load('patient.utilisateur');

        $demandeSuivi->update([
            'statut' => 'refusee',
            'date_traitement' => now(),
        ]);

        // Notification au patient.
        Notification::create([
            'titre' => 'Demande de suivi refusée',
            'type' => 'demande_suivi',
            'message' => 'Dr ' .
                $user->prenom . ' ' .
                $user->nom .
                ' a refusé votre demande de suivi.',
            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $demandeSuivi->patient->id_utilisateur,
        ]);

        return redirect()
            ->route('medecin.demandes-suivi.index')
            ->with(
                'success',
                'La demande de suivi a été refusée. Le patient a été notifié.'
            );
    }
}
