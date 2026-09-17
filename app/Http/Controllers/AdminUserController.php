<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Gestion globale des utilisateurs.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Liste des médecins.
     */
    public function medecins()
    {
        $medecins = User::where('role', 'medecin')
            ->latest()
            ->get();

        return view('admin.medecins.index', compact('medecins'));
    }

    /**
     * Liste des patients.
     *
     * On charge également :
     * - le profil Patient
     * - les médecins associés
     * - le compte utilisateur du médecin
     */
    public function patients()
    {
        $patients = User::where('role', 'patient')
            ->with([
                'patient.medecins.utilisateur',
            ])
            ->latest()
            ->get();

        return view(
            'admin.patients.index',
            compact('patients')
        );
    }

    /**
     * Liste des proches.
     */
    public function proches()
    {
        $proches = User::where('role', 'proche')
            ->latest()
            ->get();

        return view(
            'admin.proches.index',
            compact('proches')
        );
    }

    /**
     * Formulaire de modification d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }

    /**
     * Modifier le rôle et le statut d'un utilisateur.
     */
    public function update(
        Request $request,
        User $user
    ) {
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

            'specialite' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Anciennes valeurs
        |--------------------------------------------------------------------------
        */

        $oldRole = $user->role;
        $oldStatut = $user->statut;

        /*
        |--------------------------------------------------------------------------
        | Nouvelles valeurs
        |--------------------------------------------------------------------------
        */

        $newRole = $validated['role'];

        $newStatut = $validated['statut'] ?? 'active';

        /*
        |--------------------------------------------------------------------------
        | Patient et Proche = toujours actifs
        |--------------------------------------------------------------------------
        */

        if ($newRole !== 'medecin') {
            $newStatut = 'active';
        }

        /*
        |--------------------------------------------------------------------------
        | Mise à jour dans une transaction
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $user,
            $newRole,
            $newStatut,
            $validated
        ): void {

            /*
            | Mise à jour du compte utilisateur.
            */
            $user->update([
                'role' => $newRole,
                'statut' => $newStatut,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Profil Patient
            |--------------------------------------------------------------------------
            */

            if ($newRole === 'patient') {

                if (! $user->patient()->exists()) {

                    Patient::create([
                        'id_utilisateur' => $user->id,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Profil Médecin
            |--------------------------------------------------------------------------
            */

            if ($newRole === 'medecin') {

                if ($user->medecin()->exists()) {

                    /*
                    | Si le profil existe déjà, on peut modifier
                    | sa spécialité.
                    */
                    if (
                        array_key_exists(
                            'specialite',
                            $validated
                        )
                        &&
                        $validated['specialite'] !== null
                    ) {

                        $user->medecin()->update([
                            'specialite' => $validated['specialite'],
                        ]);
                    }

                } else {

                    /*
                    | Création du profil médecin.
                    */
                    Medecin::create([
                        'id_utilisateur' => $user->id,
                        'specialite' => $validated['specialite']
                            ?? 'Non renseignée',
                    ]);
                }
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Notifications concernant le statut médecin
        |--------------------------------------------------------------------------
        */

        if (
            $newRole === 'medecin'
            &&
            (
                $oldRole !== $newRole
                ||
                $oldStatut !== $newStatut
            )
        ) {

            $titre = null;
            $message = null;

            /*
            | Médecin validé.
            */
            if ($newStatut === 'active') {

                $titre = 'Compte médecin validé';

                $message =
                    'Votre demande d’accès à l’espace Médecin a été validée par un administrateur. Vous pouvez maintenant accéder à votre espace.';
            }

            /*
            | Médecin refusé.
            */
            elseif ($newStatut === 'refuse') {

                $titre = 'Demande médecin refusée';

                $message =
                    'Votre demande d’accès à l’espace Médecin a été refusée par un administrateur.';
            }

            /*
            | Médecin en attente.
            */
            elseif ($newStatut === 'en_attente') {

                $titre = 'Demande médecin en attente';

                $message =
                    'Le statut de votre demande d’accès à l’espace Médecin est actuellement en attente de validation.';
            }

            /*
            | Création de la notification.
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

        /*
        |--------------------------------------------------------------------------
        | Retour
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Les informations du compte ont été mises à jour avec succès.'
            );
    }
}
