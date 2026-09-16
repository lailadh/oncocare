<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Medecin;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Page de choix du type de compte.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | PATIENT
    |--------------------------------------------------------------------------
    */

    public function createPatient(): View
    {
        return view('auth.register-patient');
    }

    /**
     * @throws ValidationException
     */
    public function storePatient(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'telephone' => ['nullable', 'string', 'max:20'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'patient',
            'statut' => 'active',
        ]);

        Patient::create([
            'id_utilisateur' => $user->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Votre compte Patient a été créé avec succès.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | PROCHE
    |--------------------------------------------------------------------------
    */

    public function createProche(): View
    {
        return view('auth.register-proche');
    }

    /**
     * @throws ValidationException
     */
    public function storeProche(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'telephone' => ['nullable', 'string', 'max:20'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'proche',
            'statut' => 'active',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Votre compte Proche a été créé avec succès.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | MEDECIN
    |--------------------------------------------------------------------------
    */

    public function createMedecin(): View
    {
        return view('auth.register-medecin');
    }

    /**
     * @throws ValidationException
     */
    public function storeMedecin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'telephone' => ['nullable', 'string', 'max:20'],
            'specialite' => ['required', 'string', 'max:255'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Création du compte médecin
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'medecin',
            'statut' => 'en_attente',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Création du profil médecin
        |--------------------------------------------------------------------------
        */

        Medecin::create([
            'id_utilisateur' => $user->id,
            'specialite' => $validated['specialite'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Notification aux administrateurs
        |--------------------------------------------------------------------------
        */

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'titre' => 'Nouvelle demande médecin',
                'type' => 'medecin_demande',
                'message' => "Le médecin {$user->prenom} {$user->nom} a envoyé une demande d’accès à l’espace Médecin.",
                'lu' => false,
                'date_notification' => now(),
                'id_utilisateur' => $admin->id,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Votre demande d’accès Médecin a été enregistrée. Elle doit être validée par un administrateur.'
            );
    }
}