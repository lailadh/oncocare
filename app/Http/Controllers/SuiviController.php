<?php

namespace App\Http\Controllers;

use App\Models\Suivi;
use App\Models\Patient;
use Illuminate\Http\Request;

class SuiviController extends Controller
{
    /**
     * Afficher les suivis du médecin connecté.
     */
    public function index()
    {
        $user = auth()->user();

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
        $user = auth()->user();

        $medecin = $user->medecin;
//
//
        $patients = Patient::whereHas('medecins', function ($query) use ($medecin) {
            $query->where('medecins.id_medecin', $medecin->id_medecin);
        })->with('utilisateur')->get();

        return view('suivis.create', compact('patients'));
    }

    /**
     * Enregistrer un nouveau suivi.
     */
    public function store(Request $request)
    {
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
    $medecin = auth()->user()->medecin;

    // Vérifier que le suivi appartient au médecin connecté
    if ($suivi->id_medecin != $medecin->id_medecin) {
        abort(403);
    }

    $suivi->load('patient.utilisateur');

    return view('suivis.show', compact('suivi'));
}


/**
 * Afficher le formulaire de modification.
 */
public function edit(Suivi $suivi)
{
    $medecin = auth()->user()->medecin;

    if ($suivi->id_medecin != $medecin->id_medecin) {
        abort(403);
    }

    return view('suivis.edit', compact('suivi'));
}


/**
 * Mettre à jour un suivi.
 */
public function update(Request $request, Suivi $suivi)
{
    $medecin = auth()->user()->medecin;

    if ($suivi->id_medecin != $medecin->id_medecin) {
        abort(403);
    }

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
    $medecin = auth()->user()->medecin;

    if ($suivi->id_medecin != $medecin->id_medecin) {
        abort(403);
    }

    $suivi->delete();

    return redirect()
        ->route('suivis.index')
        ->with('success', 'Suivi supprimé avec succès.');
}

}