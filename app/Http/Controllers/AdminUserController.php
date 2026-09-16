<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * Liste des proches
     */
    public function proches()
    {
        $proches = User::where('role', 'proche')
            ->latest()
            ->get();

        return view('admin.proches.index', compact('proches'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Modifier le rôle et le statut d'un utilisateur
     */
    public function update(Request $request, User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Protection du compte administrateur connecté
        |--------------------------------------------------------------------------
        */

        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'Vous ne pouvez pas modifier votre propre compte depuis cette page.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'role' => [
                'required',
                Rule::in([
                    'medecin',
                    'patient',
                    'proche',
                ]),
            ],

            'statut' => [
                'nullable',
                Rule::in([
                    'active',
                    'en_attente',
                    'refuse',
                ]),
            ],
        ]);

        $oldRole = $user->role;
        $oldStatut = $user->statut;

        $newRole = $validated['role'];
        $newStatut = $validated['statut'] ?? 'active';

        /*
        |--------------------------------------------------------------------------
        | Patient et Proche = automatiquement actifs
        |--------------------------------------------------------------------------
        */

        if ($newRole !== 'medecin') {
            $newStatut = 'active';
        }

        /*
        |--------------------------------------------------------------------------
        | Mise à jour
        |--------------------------------------------------------------------------
        */

        $user->update([
            'role' => $newRole,
            'statut' => $newStatut,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Notification au médecin
        |--------------------------------------------------------------------------
        */

        if (
            $newRole === 'medecin' &&
            (
                $oldRole !== $newRole ||
                $oldStatut !== $newStatut
            )
        ) {
            $titre = null;
            $message = null;

            /*
            |----------------------------------------------
            | Compte validé
            |----------------------------------------------
            */

            if ($newStatut === 'active') {

                $titre = 'Compte médecin validé';

                $message = 'Votre demande d’accès à l’espace Médecin a été validée par un administrateur. Vous pouvez maintenant accéder à votre espace.';
            }

            /*
            |----------------------------------------------
            | Demande refusée
            |----------------------------------------------
            */

            elseif ($newStatut === 'refuse') {

                $titre = 'Demande médecin refusée';

                $message = 'Votre demande d’accès à l’espace Médecin a été refusée par un administrateur.';
            }

            /*
            |----------------------------------------------
            | Remise en attente
            |----------------------------------------------
            */

            elseif ($newStatut === 'en_attente') {

                $titre = 'Demande médecin en attente';

                $message = 'Le statut de votre demande d’accès à l’espace Médecin est actuellement en attente de validation.';
            }

            /*
            |----------------------------------------------
            | Création notification
            |----------------------------------------------
            */

            if ($titre && $message) {
                Notification::create([
                    'titre' => $titre,
                    'type' => 'medecin_statut',
                    'message' => $message,
                    'lu' => false,
                    'date_notification' => now(),
                    'id_utilisateur' => $user->id,
                ]);
            }
        }

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Les informations du compte ont été mises à jour avec succès.'
            );
    }
}