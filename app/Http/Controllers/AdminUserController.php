<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // L'admin ne peut pas modifier son propre rôle
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre rôle.');
        }

        $validated = $request->validate([
            'role' => 'required|in:admin,medecin,patient,proche',
        ]);

        $user->update([
            'role' => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Le rôle de l’utilisateur a été modifié avec succès.');
    }
}