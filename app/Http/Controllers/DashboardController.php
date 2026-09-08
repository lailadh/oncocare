<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('medecin')) {
            return view('dashboards.medecin');
        }

        if ($user->hasRole('patient')) {
            return view('dashboards.patient');
        }

        if ($user->hasRole('admin')) {
            return view('dashboards.admin');
        }

        if ($user->hasRole('proche')) {
            return view('dashboards.proche');
        }

        return view('dashboard');
    }
}