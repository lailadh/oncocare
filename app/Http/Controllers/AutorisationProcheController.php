<?php

namespace App\Http\Controllers;

use App\Models\AutorisationProche;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AutorisationProcheController extends Controller
{
    /**
     * Afficher les autorisations.
     */
    public function index()
    {
        Gate::authorize('viewAny', AutorisationProche::class);

        $user = auth()->user();

        // Patient : afficher uniquement ses propres autorisations
        if ($user->role === 'patient') {

            if (!$user->patient) {
                abort(403);
            }

            $autorisations = AutorisationProche::with('proche')
                ->where('id_patient', $user->patient->id_patient)
                ->latest('date_autorisation')
                ->get();

            return view(
                'patient.autorisations.index',
                compact('autorisations')
            );
        }

        // Proche : afficher uniquement les autorisations qui lui sont destinées
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

        $request->validate([
            'id_proche' => 'required|exists:users,id',
            'acces_suivi' => 'boolean',
            'acces_rendez_vous' => 'boolean',
        ]);

        // Vérifier que l'utilisateur sélectionné est réellement un proche
        $proche = User::findOrFail($request->id_proche);

        if ($proche->role !== 'proche') {
            abort(403);
        }

        $patient = $user->patient;

        // Éviter de créer deux autorisations identiques
        $autorisationExiste = AutorisationProche::where(
            'id_patient',
            $patient->id_patient
        )
        ->where('id_proche', $proche->id)
        ->exists();

        if ($autorisationExiste) {
            return back()
                ->withErrors([
                    'id_proche' => 'Une autorisation existe déjà pour ce proche.'
                ])
                ->withInput();
        }

        AutorisationProche::create([
            'id_patient' => $patient->id_patient,
            'id_proche' => $proche->id,
            'acces_suivi' => $request->boolean('acces_suivi'),
            'acces_rendez_vous' => $request->boolean('acces_rendez_vous'),
            'statut' => 'active',
            'date_autorisation' => now(),
        ]);

        return redirect()
            ->route('patient.autorisations.index')
            ->with('success', 'Autorisation ajoutée avec succès.');
    }

    /**
     * Formulaire de modification d'une autorisation.
     */
    public function edit(AutorisationProche $autorisationProche)
    {
        Gate::authorize('update', $autorisationProche);

        $user = auth()->user();

        // Seul le patient propriétaire peut modifier
        if (
            $user->role !== 'patient' ||
            !$user->patient ||
            $autorisationProche->id_patient !== $user->patient->id_patient
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
        Gate::authorize('update', $autorisationProche);

        $user = auth()->user();

        // Vérifier que l'autorisation appartient au patient connecté
        if (
            $user->role !== 'patient' ||
            !$user->patient ||
            $autorisationProche->id_patient !== $user->patient->id_patient
        ) {
            abort(403);
        }

        $request->validate([
            'acces_suivi' => 'boolean',
            'acces_rendez_vous' => 'boolean',
            'statut' => 'required|string|max:50',
        ]);

        $autorisationProche->update([
            'acces_suivi' => $request->boolean('acces_suivi'),
            'acces_rendez_vous' => $request->boolean('acces_rendez_vous'),
            'statut' => $request->statut,
        ]);

        return redirect()
            ->route('patient.autorisations.index')
            ->with('success', 'Autorisation modifiée avec succès.');
    }

    /**
     * Supprimer une autorisation.
     */
    public function destroy(AutorisationProche $autorisationProche)
    {
        Gate::authorize('delete', $autorisationProche);

        $user = auth()->user();

        // Vérifier que l'autorisation appartient au patient connecté
        if (
            $user->role !== 'patient' ||
            !$user->patient ||
            $autorisationProche->id_patient !== $user->patient->id_patient
        ) {
            abort(403);
        }

        $autorisationProche->delete();

        return redirect()
            ->route('patient.autorisations.index')
            ->with('success', 'Autorisation supprimée avec succès.');
    }
}