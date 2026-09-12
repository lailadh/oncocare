<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RendezVousController extends Controller
{
    /**
     * Liste des rendez-vous du médecin connecté.
     */
    public function index()
    {
        Gate::authorize('viewAny', RendezVous::class);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        $rendezVous = RendezVous::with('patient.utilisateur')
            ->where('id_medecin', $user->medecin->id_medecin)
            ->latest('date_heure')
            ->get();

        return view('rendezvous.index', compact('rendezVous'));
    }

    /**
     * Formulaire de demande de rendez-vous pour le patient.
     */
    public function create()
    {
        Gate::authorize('create', RendezVous::class);

        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $patient = $user->patient;

        $medecins = $patient->medecins()
            ->with('utilisateur')
            ->get();

        return view('rendezvous.create', compact('medecins'));
    }

    /**
     * Enregistrer une demande de rendez-vous.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', RendezVous::class);

        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $request->validate([
            'date_heure' => 'required|date|after:now',
            'motif' => 'required|string|max:1000',
            'id_medecin' => 'required|exists:medecins,id_medecin',
        ]);

        $patient = $user->patient;

        // Vérifier que le médecin est lié au patient
        $medecinExiste = $patient->medecins()
            ->where('medecins.id_medecin', $request->id_medecin)
            ->exists();

        if (!$medecinExiste) {
            abort(403);
        }

        // Créer le rendez-vous
        RendezVous::create([
            'date_heure' => $request->date_heure,
            'motif' => $request->motif,
            'statut' => 'en_attente',
            'id_patient' => $patient->id_patient,
            'id_medecin' => $request->id_medecin,
        ]);

        // Récupérer le médecin
        $medecin = \App\Models\Medecin::findOrFail($request->id_medecin);

        // Notification au médecin
        Notification::create([
            'titre' => 'Nouvelle demande de rendez-vous',
            'type' => 'rendezvous',
            'message' => 'Le patient ' . $user->prenom . ' ' . $user->nom . ' a envoyé une demande de rendez-vous.',
            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $medecin->id_utilisateur,
        ]);

        return redirect()
            ->route('patient.rendezvous.index')
            ->with('success', 'Demande de rendez-vous envoyée avec succès.');
    }

    /**
     * Afficher un rendez-vous pour le médecin.
     */
    public function show(RendezVous $rendezVous)
    {
        Gate::authorize('view', $rendezVous);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient au médecin connecté
        if ($rendezVous->id_medecin !== $user->medecin->id_medecin) {
            abort(403);
        }

        $rendezVous->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view('rendezvous.show', compact('rendezVous'));
    }

    /**
     * Formulaire de modification du statut par le médecin.
     */
    public function edit(RendezVous $rendezVous)
    {
        Gate::authorize('update', $rendezVous);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient au médecin connecté
        if ($rendezVous->id_medecin !== $user->medecin->id_medecin) {
            abort(403);
        }

        return view('rendezvous.edit', compact('rendezVous'));
    }

    /**
     * Modifier le statut du rendez-vous.
     */
    public function update(Request $request, RendezVous $rendezVous)
    {
        Gate::authorize('update', $rendezVous);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient au médecin connecté
        if ($rendezVous->id_medecin !== $user->medecin->id_medecin) {
            abort(403);
        }

        $request->validate([
            'statut' => 'required|in:en_attente,confirme,refuse',
        ]);

        // Modifier le statut
        $rendezVous->update([
            'statut' => $request->statut,
        ]);

        // Récupérer le patient
        $rendezVous->load('patient');

        // Traduction du statut pour la notification
        $statuts = [
            'en_attente' => 'En attente',
            'confirme' => 'Confirmé',
            'refuse' => 'Refusé',
        ];

        $statutLabel = $statuts[$request->statut];

        // Notification au patient
        Notification::create([
            'titre' => 'Statut du rendez-vous modifié',
            'type' => 'rendezvous',
            'message' => 'Le statut de votre rendez-vous a été modifié : ' . $statutLabel . '.',
            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $rendezVous->patient->id_utilisateur,
        ]);

        return redirect()
            ->route('rendezvous.index')
            ->with('success', 'Statut du rendez-vous modifié avec succès.');
    }

    /**
     * Supprimer un rendez-vous.
     */
    public function destroy(RendezVous $rendezVous)
    {
        Gate::authorize('delete', $rendezVous);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient au médecin connecté
        if ($rendezVous->id_medecin !== $user->medecin->id_medecin) {
            abort(403);
        }

        $rendezVous->delete();

        return redirect()
            ->route('rendezvous.index')
            ->with('success', 'Rendez-vous supprimé avec succès.');
    }

    /**
     * Liste des rendez-vous du patient connecté.
     */
    public function patientRendezVous()
    {
        Gate::authorize('viewAny', RendezVous::class);

        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $rendezVous = RendezVous::with('medecin.utilisateur')
            ->where('id_patient', $user->patient->id_patient)
            ->latest('date_heure')
            ->get();

        return view(
            'patient.rendezvous.index',
            compact('rendezVous')
        );
    }

    /**
     * Détails d'un rendez-vous pour le patient.
     */
    public function patientShow(RendezVous $rendezVous)
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        // Vérifier que le rendez-vous appartient bien au patient connecté
        if ($rendezVous->id_patient !== $user->patient->id_patient) {
            abort(403);
        }

        $rendezVous->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view(
            'patient.rendezvous.show',
            compact('rendezVous')
        );
    }

    /**
     * Liste des rendez-vous accessibles au proche.
     */
    public function procheRendezVous()
    {
        $user = auth()->user();

        if ($user->role !== 'proche') {
            abort(403);
        }

        $autorisations = \App\Models\AutorisationProche::where(
            'id_proche',
            $user->id
        )
        ->where('statut', 'active')
        ->where('acces_rendez_vous', 1)
        ->get();

        $patientIds = $autorisations->pluck('id_patient');

        $rendezVous = RendezVous::with([
            'patient.utilisateur',
            'medecin.utilisateur',
        ])
        ->whereIn('id_patient', $patientIds)
        ->latest('date_heure')
        ->get();

        return view(
            'proche.rendezvous.index',
            compact('rendezVous')
        );
    }

    /**
     * Détails d'un rendez-vous accessible au proche.
     */
    public function procheShow(RendezVous $rendezVous)
    {
        $user = auth()->user();

        if ($user->role !== 'proche') {
            abort(403);
        }

        // Vérifier que le proche a bien accès aux rendez-vous du patient
        $autorise = \App\Models\AutorisationProche::where(
            'id_proche',
            $user->id
        )
        ->where('id_patient', $rendezVous->id_patient)
        ->where('statut', 'active')
        ->where('acces_rendez_vous', 1)
        ->exists();

        if (!$autorise) {
            abort(403);
        }

        $rendezVous->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view(
            'proche.rendezvous.show',
            compact('rendezVous')
        );
    }
}