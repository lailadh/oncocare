<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Gestion globale des utilisateurs
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Liste des médecins
     */
    public function medecins()
    {
        $medecins = User::where('role', 'medecin')
            ->latest()
            ->get();

        return view('admin.medecins.index', compact('medecins'));
    }

    /**
     * Liste des patients
     */
    public function patients()
    {
        $patients = User::where('role', 'patient')
            ->latest()
            ->get();

        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Modifier un utilisateur
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Modifier le rôle d'un utilisateur
     */
    public function update(Request $request, User $user)
    {
        // L'admin ne peut pas modifier son propre rôle
        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'Vous ne pouvez pas modifier votre propre rôle.'
            );
        }

        $validated = $request->validate([
            'role' => 'required|in:admin,medecin,patient,proche',
        ]);

        $user->update([
            'role' => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Le rôle de l’utilisateur a été modifié avec succès.'
            );
    }
}
