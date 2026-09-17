<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->with('patient.medecins.utilisateur')
            ->latest()
            ->get();

        $medecins = Medecin::whereHas('utilisateur', function ($query): void {
            $query->where('role', 'medecin')
                ->where('statut', 'active');
        })
            ->with('utilisateur')
            ->orderBy('id_medecin')
            ->get();

        return view('admin.patients.index', compact('patients', 'medecins'));
    }

    /**
     * Associer un médecin actif au dossier d'un patient.
     */
    public function assignerMedecin(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'id_medecin' => [
                'required',
                'exists:medecins,id_medecin',
            ],
        ]);

        $medecin = Medecin::with('utilisateur')->findOrFail($validated['id_medecin']);

        if ($medecin->utilisateur?->role !== 'medecin' || $medecin->utilisateur?->statut !== 'active') {
            return back()->withErrors([
                'id_medecin' => 'Seuls les médecins actifs peuvent être associés.',
            ]);
        }

        if ($patient->medecins()->whereKey($medecin->id_medecin)->exists()) {
            return back()->withErrors([
                'id_medecin' => 'Ce médecin est déjà associé à ce patient.',
            ]);
        }

        DB::transaction(function () use ($patient, $medecin): void {
            $patient->medecins()->attach($medecin->id_medecin);

            Notification::create([
                'titre' => 'Nouveau patient suivi',
                'type' => 'suivi_patient',
                'message' => 'Un patient vous a été associé par l’administration.',
                'lu' => false,
                'date_notification' => now(),
                'id_utilisateur' => $medecin->utilisateur->id,
            ]);

            Notification::create([
                'titre' => 'Médecin associé à votre dossier',
                'type' => 'suivi_patient',
                'message' => "Le Dr {$medecin->utilisateur->prenom} {$medecin->utilisateur->nom} a été associé à votre dossier.",
                'lu' => false,
                'date_notification' => now(),
                'id_utilisateur' => $patient->id_utilisateur,
            ]);
        });

        return back()->with('success', 'Le médecin a été associé au patient.');
    }

    /**
     * Retirer un médecin du dossier d'un patient.
     */
    public function retirerMedecin(Patient $patient, Medecin $medecin)
    {
        if (!$patient->medecins()->whereKey($medecin->id_medecin)->exists()) {
            return back()->withErrors([
                'medecin' => 'Ce médecin n’est pas associé à ce patient.',
            ]);
        }

        $patient->medecins()->detach($medecin->id_medecin);

        return back()->with('success', 'Le médecin a été retiré du dossier patient.');
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

            'specialite' => [
                'nullable',
                'string',
                'max:255',
                Rule::requiredIf(fn(): bool => $request->input('role') === 'medecin'),
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

        DB::transaction(function () use ($user, $newRole, $newStatut, $validated): void {
            $user->update([
                'role' => $newRole,
                'statut' => $newStatut,
            ]);

            if ($newRole === 'patient' && !$user->patient()->exists()) {
                Patient::create([
                    'id_utilisateur' => $user->id,
                ]);
            }

            if ($newRole === 'medecin') {
                if ($user->medecin()->exists()) {
                    $user->medecin()->update([
                        'specialite' => $validated['specialite'],
                    ]);
                } else {
                    Medecin::create([
                        'id_utilisateur' => $user->id,
                        'specialite' => $validated['specialite'],
                    ]);
                }
            }
        });

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
            */ elseif ($newStatut === 'refuse') {

                $titre = 'Demande médecin refusée';

                $message = 'Votre demande d’accès à l’espace Médecin a été refusée par un administrateur.';
            }

            /*
            |----------------------------------------------
            | Remise en attente
            |----------------------------------------------
            */ elseif ($newStatut === 'en_attente') {

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