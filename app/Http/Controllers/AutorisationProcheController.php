<?php

namespace App\Http\Controllers;

use App\Models\AutorisationProche;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AutorisationProcheController extends Controller
{
    /**
     * Afficher les autorisations.
     */
    public function index()
    {
        Gate::authorize('viewAny', AutorisationProche::class);

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'patient') {

            if (!$user->patient) {
                abort(403);
            }

            $autorisations = AutorisationProche::with('proche')
                ->where(
                    'id_patient',
                    $user->patient->id_patient
                )
                ->latest('date_autorisation')
                ->get();

            return view(
                'patient.autorisations.index',
                compact('autorisations')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PROCHE
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'proche') {

            $autorisations = AutorisationProche::with('patient.utilisateur')
                ->where('id_proche', $user->id)
                ->where('statut', 'active')
                ->get();

            return view(
                'proche.autorisations.index',
                compact('autorisations')
            );
        }

        abort(403);
    }


    /**
     * Formulaire de création d'une autorisation.
     */
    public function create()
    {
        Gate::authorize('create', AutorisationProche::class);

        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        $proches = User::where('role', 'proche')
            ->orderBy('nom')
            ->get();

        return view(
            'patient.autorisations.create',
            compact('proches')
        );
    }


    /**
     * Enregistrer une nouvelle autorisation.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', AutorisationProche::class);

        $user = auth()->user();

        if ($user->role !== 'patient' || !$user->patient) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'id_proche' => [
                'required',
                'exists:users,id',
            ],

            'acces_suivi' => [
                'boolean',
            ],

            'acces_rendez_vous' => [
                'boolean',
            ],
        ], [
            'id_proche.required' =>
                'Veuillez sélectionner un proche.',

            'id_proche.exists' =>
                'Le proche sélectionné est invalide.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Vérifier le rôle du proche
        |--------------------------------------------------------------------------
        */

        $proche = User::findOrFail(
            $request->id_proche
        );

        if ($proche->role !== 'proche') {
            abort(403);
        }

        $patient = $user->patient;

        /*
        |--------------------------------------------------------------------------
        | Éviter les doublons
        |--------------------------------------------------------------------------
        */

        $autorisationExiste = AutorisationProche::where(
            'id_patient',
            $patient->id_patient
        )
            ->where(
                'id_proche',
                $proche->id
            )
            ->exists();

        if ($autorisationExiste) {
            return back()
                ->withErrors([
                    'id_proche' =>
                        'Une autorisation existe déjà pour ce proche.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Création
        |--------------------------------------------------------------------------
        */

        $autorisation = AutorisationProche::create([
            'id_patient' => $patient->id_patient,
            'id_proche' => $proche->id,
            'acces_suivi' => $request->boolean('acces_suivi'),
            'acces_rendez_vous' => $request->boolean('acces_rendez_vous'),
            'statut' => 'active',
            'date_autorisation' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Notification au proche
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'titre' => 'Nouvelle autorisation d’accès',
            'type' => 'autorisation',

            'message' =>
                'Le patient ' .
                $user->prenom . ' ' .
                $user->nom .
                ' vous a accordé un accès à certaines informations de son suivi.',

            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $proche->id,
        ]);

        return redirect()
            ->route('patient.autorisations.index')
            ->with(
                'success',
                'Autorisation ajoutée avec succès. Le proche a été notifié.'
            );
    }


    /**
     * Formulaire de modification d'une autorisation.
     */
    public function edit(
        AutorisationProche $autorisationProche
    ) {
        Gate::authorize(
            'update',
            $autorisationProche
        );

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Vérifier le propriétaire
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'patient' ||
            !$user->patient ||
            $autorisationProche->id_patient !==
            $user->patient->id_patient
        ) {
            abort(403);
        }

        return view(
            'patient.autorisations.edit',
            compact('autorisationProche')
        );
    }


    /**
     * Modifier une autorisation.
     */
    public function update(
        Request $request,
        AutorisationProche $autorisationProche
    ) {
        Gate::authorize(
            'update',
            $autorisationProche
        );

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Vérifier le propriétaire
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'patient' ||
            !$user->patient ||
            $autorisationProche->id_patient !==
            $user->patient->id_patient
        ) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'acces_suivi' => [
                'boolean',
            ],

            'acces_rendez_vous' => [
                'boolean',
            ],

            'statut' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],
        ], [
            'statut.required' =>
                'Veuillez sélectionner un statut.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Récupérer les infos avant modification
        |--------------------------------------------------------------------------
        */

        $proche = User::findOrFail(
            $autorisationProche->id_proche
        );

        /*
        |--------------------------------------------------------------------------
        | Anciennes valeurs
        |--------------------------------------------------------------------------
        */

        $ancienAccesSuivi =
            (bool) $autorisationProche->acces_suivi;

        $ancienAccesRendezVous =
            (bool) $autorisationProche->acces_rendez_vous;

        $ancienStatut =
            $autorisationProche->statut;

        /*
        |--------------------------------------------------------------------------
        | Nouvelles valeurs
        |--------------------------------------------------------------------------
        */

        $nouvelAccesSuivi =
            $request->boolean('acces_suivi');

        $nouvelAccesRendezVous =
            $request->boolean('acces_rendez_vous');

        $nouveauStatut =
            $request->statut;

        /*
        |--------------------------------------------------------------------------
        | Mise à jour
        |--------------------------------------------------------------------------
        */

        $autorisationProche->update([
            'acces_suivi' => $nouvelAccesSuivi,
            'acces_rendez_vous' => $nouvelAccesRendezVous,
            'statut' => $nouveauStatut,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Déterminer s'il y a réellement un changement
        |--------------------------------------------------------------------------
        */

        $autorisationModifiee =
            $ancienAccesSuivi !== $nouvelAccesSuivi ||
            $ancienAccesRendezVous !== $nouvelAccesRendezVous ||
            $ancienStatut !== $nouveauStatut;

        /*
        |--------------------------------------------------------------------------
        | Notification au proche
        |--------------------------------------------------------------------------
        */

        if ($autorisationModifiee) {

            if ($nouveauStatut === 'active') {

                $titre =
                    'Autorisation mise à jour';

                $message =
                    'Le patient ' .
                    $user->prenom . ' ' .
                    $user->nom .
                    ' a mis à jour vos autorisations d’accès.';
            } else {

                $titre =
                    'Autorisation modifiée';

                $message =
                    'Les autorisations d’accès du patient ' .
                    $user->prenom . ' ' .
                    $user->nom .
                    ' ont été modifiées.';
            }

            Notification::create([
                'titre' => $titre,
                'type' => 'autorisation',
                'message' => $message,
                'lu' => false,
                'date_notification' => now(),
                'id_utilisateur' => $proche->id,
            ]);
        }

        return redirect()
            ->route('patient.autorisations.index')
            ->with(
                'success',
                'Autorisation modifiée avec succès. Le proche a été notifié.'
            );
    }


    /**
     * Supprimer une autorisation.
     */
    public function destroy(
        AutorisationProche $autorisationProche
    ) {
        Gate::authorize(
            'delete',
            $autorisationProche
        );

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Vérifier le propriétaire
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'patient' ||
            !$user->patient ||
            $autorisationProche->id_patient !==
            $user->patient->id_patient
        ) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Récupérer le proche avant suppression
        |--------------------------------------------------------------------------
        */

        $proche = User::findOrFail(
            $autorisationProche->id_proche
        );

        /*
        |--------------------------------------------------------------------------
        | Supprimer l'autorisation
        |--------------------------------------------------------------------------
        */

        $autorisationProche->delete();

        /*
        |--------------------------------------------------------------------------
        | Notification au proche
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'titre' => 'Accès retiré',
            'type' => 'autorisation',

            'message' =>
                'Le patient ' .
                $user->prenom . ' ' .
                $user->nom .
                ' a retiré votre autorisation d’accès à ses informations.',

            'lu' => false,
            'date_notification' => now(),
            'id_utilisateur' => $proche->id,
        ]);

        return redirect()
            ->route('patient.autorisations.index')
            ->with(
                'success',
                'Autorisation supprimée avec succès. Le proche a été notifié.'
            );
    }
}