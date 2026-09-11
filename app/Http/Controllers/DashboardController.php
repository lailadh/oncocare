<?php

namespace App\Http\Controllers;

use App\Models\AutorisationProche;
use App\Models\Suivi;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Dashboard Médecin
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'medecin') {

            if (!$user->medecin) {
                abort(403);
            }

            $medecin = $user->medecin;

            // Nombre de patients suivis
            $nombrePatients = $medecin->patients()->count();

            // Prochain rendez-vous
            $prochainRendezVous = $medecin->rendezVous()
                ->where('date_heure', '>=', now())
                ->orderBy('date_heure')
                ->with('patient.utilisateur')
                ->first();

            // Dernier suivi ajouté
            $dernierSuivi = Suivi::with('patient.utilisateur')
                ->where('id_medecin', $medecin->id_medecin)
                ->latest('date_suivi')
                ->first();

            return view(
                'dashboards.medecin',
                compact(
                    'nombrePatients',
                    'prochainRendezVous',
                    'dernierSuivi'
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard Patient
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'patient') {

            if (!$user->patient) {
                abort(403);
            }

            $patient = $user->patient;

            $dernierSuivi = $patient->suivis()
                ->latest('date_suivi')
                ->first();

            $prochainRendezVous = $patient->rendezVous()
                ->where('date_heure', '>=', now())
                ->orderBy('date_heure')
                ->first();

            $nombreProches = AutorisationProche::where(
                'id_patient',
                $patient->id_patient
            )
            ->where('statut', 'active')
            ->count();

            return view(
                'dashboards.patient',
                compact(
                    'dernierSuivi',
                    'prochainRendezVous',
                    'nombreProches'
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard Admin
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'admin') {
            return view('dashboards.admin');
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard Proche
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'proche') {

            $autorisations = AutorisationProche::with([
                'patient.utilisateur'
            ])
            ->where('id_proche', $user->id)
            ->where('statut', 'active')
            ->get();

            return view(
                'dashboards.proche',
                compact('autorisations')
            );
        }

        abort(403);
    }
}
