<?php

namespace App\Http\Controllers;

use App\Models\AutorisationProche;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'medecin') {
            return view('dashboards.medecin');
        }

        if ($user->role === 'patient') {
            return view('dashboards.patient');
        }

        if ($user->role === 'admin') {
            return view('dashboards.admin');
        }

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