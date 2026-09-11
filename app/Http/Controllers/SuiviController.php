<?php

namespace App\Http\Controllers;

use App\Models\Suivi;
use App\Models\Patient;
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

        $suivis = Suivi::with(['patient.utilisateur'])
            ->where('id_medecin', $medecin->id_medecin)
            ->latest('date_suivi')
            ->get();

        return view('suivis.index', compact('suivis'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        Gate::authorize('create', Suivi::class);

        $user = auth()->user();
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

        // Vérifier que le patient appartient bien au médecin connecté
        $patientExiste = $medecin->patients()
            ->where('patients.id_patient', $request->id_patient)
            ->exists();

        if (!$patientExiste) {
            abort(403);
        }

        Suivi::create([
            'date_suivi' => $request->date_suivi,
            'type_cancer' => $request->type_cancer,
            'stade' => $request->stade,
            'observation' => $request->observation,
            'evolution' => $request->evolution,
            'traitement' => $request->traitement,
            'id_patient' => $request->id_patient,
            'id_medecin' => $medecin->id_medecin,
        ]);

        return redirect()
            ->route('suivis.index')
            ->with('success', 'Suivi ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un suivi.
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
     */
    public function procheSuivis()
    {
        $user = auth()->user();

        if ($user->role !== 'proche') {
            abort(403);
        }

        $autorisations = \App\Models\AutorisationProche::with([
            'patient.utilisateur'
        ])
        ->where('id_proche', $user->id)
        ->where('statut', 'active')
        ->where('acces_suivi', 1)
        ->get();

        $patientIds = $autorisations->pluck('id_patient');

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
     * Afficher les détails d'un suivi accessible au proche.
     */
    public function procheShow(Suivi $suivi)
    {
        $user = auth()->user();

        if ($user->role !== 'proche') {
            abort(403);
        }

        // Vérifier que le proche a bien accès au suivi
        $autorise = \App\Models\AutorisationProche::where(
            'id_proche',
            $user->id
        )
        ->where('id_patient', $suivi->id_patient)
        ->where('statut', 'active')
        ->where('acces_suivi', 1)
        ->exists();

        if (!$autorise) {
            abort(403);
        }

        $suivi->load([
            'patient.utilisateur',
            'medecin.utilisateur',
        ]);

        return view('proche.suivis.show', compact('suivi'));
    }

    /**
     * Afficher le formulaire de modification.
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
     * Afficher les détails d'un suivi du patient.
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