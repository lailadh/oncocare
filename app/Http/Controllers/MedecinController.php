<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class MedecinController extends Controller
{
    /**
     * Liste des patients du médecin connecté.
     */
    public function patients()
    {
        $user = auth()->user();

        $medecin = $user->medecin;

        if (!$medecin) {
            abort(403);
        }

        $patients = $medecin->patients()
            ->with('utilisateur')
            ->get();

        return view('medecin.patients.index', compact('patients'));
    }

    /**
     * Dossier d'un patient suivi par le médecin connecté.
     */
    public function showPatient(Patient $patient)
    {
        $user = auth()->user();

        $medecin = $user->medecin;

        if (!$medecin) {
            abort(403);
        }

        // Vérifier que le médecin suit bien ce patient
        $patientAutorise = $medecin->patients()
            ->where('patients.id_patient', $patient->id_patient)
            ->exists();

        if (!$patientAutorise) {
            abort(403);
        }

        $patient->load([
            'utilisateur',
            'suivis',
        ]);

        return view('medecin.patients.show', compact('patient'));
    }
}
