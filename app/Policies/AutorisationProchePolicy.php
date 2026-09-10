<?php

namespace App\Policies;

use App\Models\AutorisationProche;
use App\Models\User;

class AutorisationProchePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['patient', 'proche']);
    }

    public function view(User $user, AutorisationProche $autorisation): bool
    {
        // Patient: يشوف غير autorisations ديالو
        if ($user->role === 'patient' && $user->patient) {
            return $autorisation->id_patient === $user->patient->id_patient;
        }

        // Proche: يشوف غير autorisations اللي مربوط بها
        if ($user->role === 'proche') {
            return $autorisation->id_proche === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->role === 'patient'
            && $user->patient !== null;
    }

    public function update(User $user, AutorisationProche $autorisation): bool
    {
        return $user->role === 'patient'
            && $user->patient !== null
            && $autorisation->id_patient === $user->patient->id_patient;
    }

    public function delete(User $user, AutorisationProche $autorisation): bool
    {
        return $user->role === 'patient'
            && $user->patient !== null
            && $autorisation->id_patient === $user->patient->id_patient;
    }
}