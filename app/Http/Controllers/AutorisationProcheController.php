<?php

namespace App\Http\Controllers;

use App\Models\AutorisationProche;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AutorisationProcheController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', AutorisationProche::class);

        $user = auth()->user();

        if ($user->role === 'patient') {
            $autorisations = AutorisationProche::with('proche')
                ->where('id_patient', $user->patient->id_patient)
                ->get();

            return view('patient.autorisations.index', compact('autorisations'));
        }

        if ($user->role === 'proche') {
            $autorisations = AutorisationProche::with('patient.utilisateur')
                ->where('id_proche', $user->id)
                ->where('statut', 'active')
                ->get();

            return view('proche.autorisations.index', compact('autorisations'));
        }

        abort(403);
    }

    public function create()
    {
        Gate::authorize('create', AutorisationProche::class);

        $proches = User::where('role', 'proche')
            ->orderBy('nom')
            ->get();

        return view('patient.autorisations.create', compact('proches'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', AutorisationProche::class);

        $request->validate([
            'id_proche' => 'required|exists:users,id',
            'acces_suivi' => 'boolean',
            'acces_rendez_vous' => 'boolean',
        ]);

        $proche = User::findOrFail($request->id_proche);

        if ($proche->role !== 'proche') {
            abort(403);
        }

        $patient = auth()->user()->patient;

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

    public function edit(AutorisationProche $autorisationProche)
    {
        Gate::authorize('update', $autorisationProche);

        return view(
            'patient.autorisations.edit',
            compact('autorisationProche')
        );
    }

    public function update(
        Request $request,
        AutorisationProche $autorisationProche
    ) {
        Gate::authorize('update', $autorisationProche);

        $request->validate([
            'acces_suivi' => 'boolean',
            'acces_rendez_vous' => 'boolean',
            'statut' => 'required|string',
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

    public function destroy(AutorisationProche $autorisationProche)
    {
        Gate::authorize('delete', $autorisationProche);

        $autorisationProche->delete();

        return redirect()
            ->route('patient.autorisations.index')
            ->with('success', 'Autorisation supprimée avec succès.');
    }
}