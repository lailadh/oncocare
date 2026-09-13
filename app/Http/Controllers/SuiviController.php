<?php

namespace App\Http\Controllers;

use App\Models\Suivi;
use App\Models\Patient;
use App\Models\Notification;
use App\Models\AutorisationProche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SuiviController extends Controller
{
    /**
     * Afficher les suivis du médecin connecté.
     */
    public function index()
    {
        Gate::authorize('viewAny', Suivi::class);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        $medecin = $user->medecin;

        $suivis = Suivi::with([
            'patient.utilisateur'
        ])
        ->where('id_medecin', $medecin->id_medecin)
        ->latest('date_suivi')
        ->get();

        return view('suivis.index', compact('suivis'));
    }


    /**
     * Afficher le formulaire de création d'un suivi.
     */
    public function create()
    {
        Gate::authorize('create', Suivi::class);

        $user = auth()->user();

        if ($user->role !== 'medecin' || !$user->medecin) {
            abort(403);
        }

        $medecin = $user->medecin;

        $patients = Patient::whereHas('medecins', function ($query) use ($medecin) {
            $query->where(
                'medecins.id_medecin',
                $medecin->id_medecin
            );
        })
        ->with('utilisateur')
        ->get();

        return view('suivis.create', compact('patients'));
    }


    /**
     * Enregistrer un nouveau suivi.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Suivi::class);

        $request->validate([
            'date_suivi' => 'required|date',
            'type_cancer' => 'required|string',
            'stade' => 'required|string',
            'observation' => 'nullable|string',
            'evolution' => 'nullable|string',
            'traitement' => 'nullable|string',
            'id_patient' => 'required|exists:patients,id_patient',
        ]);

        $medecin = auth()->user()->medecin;

        if (!$medecin) {
            abort(403);
        }

        // Vérifier que le patient est bien suivi par le médecin connecté
        $patientExiste = $medecin->patients()
            ->where('patients.id_patient', $request->id_patient)
            ->exists();

        if (!$patientExiste) {
            abort(403);
        }

        // Créer le suivi
        $suivi = Suivi::create([
            'date_suivi' => $request->date_suivi,
            'type_cancer' => $request->type_cancer,
            'stade' => $request->stade,
            'observation' => $request->observation,
            'evolution' => $request->evolution,
            'traitement' => $request->traitement,
            'id_patient' => $request->id_patient,
            'id_medecin' => $medecin->id_medecin,
        ]);

        // Récupérer le patient
        $patient = Patient::findOrFail($request->id_patient);

        // Notification au patient
        Notification::create([
            'titre' => 'Nouveau suivi médical',
            'type' => 'suivi',
            'message' => 'Un nouveau suivi médical a été ajouté à votre dossier.',
            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $patient->id_utilisateur,
        ]);

        return redirect()
            ->route('suivis.index')
            ->with('success', 'Suivi ajouté avec succès.');
    }


    /**
     * Afficher les détails d'un suivi pour le médecin.
     */
    public function show(Suivi $suivi)
    {
        Gate::authorize('view', $suivi);

        $suivi->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view('suivis.show', compact('suivi'));
    }


    /**
     * Afficher les suivis accessibles au proche.
     *
     * Le proche peut uniquement voir les suivis
     * lorsque acces_suivi = 1.
     */
    public function procheSuivis()
    {
        $user = auth()->user();

        // Vérifier que l'utilisateur connecté est bien un proche
        if ($user->role !== 'proche') {
            abort(403);
        }

        /*
         * Chercher uniquement les autorisations :
         * - appartenant au proche connecté
         * - actives
         * - avec accès aux suivis
         */
        $autorisations = AutorisationProche::where(
            'id_proche',
            $user->id
        )
        ->where('statut', 'active')
        ->where('acces_suivi', 1)
        ->get();

        // Récupérer les IDs des patients autorisés
        $patientIds = $autorisations->pluck('id_patient');

        // Récupérer uniquement leurs suivis
        $suivis = Suivi::with([
            'patient.utilisateur',
            'medecin.utilisateur'
        ])
        ->whereIn('id_patient', $patientIds)
        ->latest('date_suivi')
        ->get();

        return view('proche.suivis.index', compact('suivis'));
    }


    /**
     * Afficher le détail d'un suivi accessible au proche.
     *
     * L'accès est refusé si acces_suivi = 0.
     */
    public function procheShow(Suivi $suivi)
    {
        $user = auth()->user();

        // Vérifier que l'utilisateur connecté est un proche
        if ($user->role !== 'proche') {
            abort(403);
        }

        /*
         * Vérifier que le proche possède :
         * - une autorisation active
         * - pour le patient concerné
         * - avec accès aux suivis
         */
        $autorise = AutorisationProche::where(
            'id_proche',
            $user->id
        )
        ->where(
            'id_patient',
            $suivi->id_patient
        )
        ->where('statut', 'active')
        ->where('acces_suivi', 1)
        ->exists();

        // Si acces_suivi = 0 => accès refusé
        if (!$autorise) {
            abort(403);
        }

        // Charger les informations nécessaires
        $suivi->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view('proche.suivis.show', compact('suivi'));
    }


    /**
     * Afficher le formulaire de modification d'un suivi.
     */
    public function edit(Suivi $suivi)
    {
        Gate::authorize('update', $suivi);

        return view('suivis.edit', compact('suivi'));
    }


    /**
     * Mettre à jour un suivi.
     */
    public function update(Request $request, Suivi $suivi)
    {
        Gate::authorize('update', $suivi);

        $request->validate([
            'date_suivi' => 'required|date',
            'type_cancer' => 'required|string',
            'stade' => 'required|string',
            'observation' => 'nullable|string',
            'evolution' => 'nullable|string',
            'traitement' => 'nullable|string',
        ]);

        $suivi->update([
            'date_suivi' => $request->date_suivi,
            'type_cancer' => $request->type_cancer,
            'stade' => $request->stade,
            'observation' => $request->observation,
            'evolution' => $request->evolution,
            'traitement' => $request->traitement,
        ]);

        // Charger le patient
        $suivi->load('patient');

        // Notification au patient
        Notification::create([
            'titre' => 'Suivi médical mis à jour',
            'type' => 'suivi',
            'message' => 'Votre suivi médical a été mis à jour par votre médecin.',
            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $suivi->patient->id_utilisateur,
        ]);

        return redirect()
            ->route('suivis.index')
            ->with('success', 'Suivi modifié avec succès.');
    }


    /**
     * Supprimer un suivi.
     */
    public function destroy(Suivi $suivi)
    {
        Gate::authorize('delete', $suivi);

        $suivi->delete();

        return redirect()
            ->route('suivis.index')
            ->with('success', 'Suivi supprimé avec succès.');
    }


    /**
     * Afficher les suivis du patient connecté.
     */
    public function patientSuivis()
    {
        Gate::authorize('viewAny', Suivi::class);

        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $patient = $user->patient;

        $suivis = $patient->suivis()
            ->with('medecin.utilisateur')
            ->latest('date_suivi')
            ->get();

        return view('patient.suivis.index', compact('suivis'));
    }


    /**
     * Afficher le détail d'un suivi pour le patient.
     */
    public function patientShow(Suivi $suivi)
    {
        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        // Vérifier que le suivi appartient bien au patient connecté
        if ($suivi->id_patient !== $user->patient->id_patient) {
            abort(403);
        }

        $suivi->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view('patient.suivis.show', compact('suivi'));
    }
}