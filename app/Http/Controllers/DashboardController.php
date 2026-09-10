<?php

namespace App\Http\Controllers;

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
            return view('dashboards.proche');
        }

        abort(403);
    }
}