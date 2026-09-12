<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPatients = User::where('role', 'patient')->count();
        $totalMedecins = User::where('role', 'medecin')->count();
        $totalProches = User::where('role', 'proche')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPatients',
            'totalMedecins',
            'totalProches'
        ));
    }
}