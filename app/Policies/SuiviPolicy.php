<?php

namespace App\Policies;

use App\Models\Suivi;
use App\Models\User;

class SuiviPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('suivi.view');
    }

    public function view(User $user, Suivi $suivi): bool
    {
        // Admin
        if ($user->hasRole('admin')) {
            return true;
        }

        // Médecin: uniquement ses propres suivis
        if (
            $user->hasPermission('suivi.view') &&
            $user->medecin &&
            $suivi->id_medecin === $user->medecin->id_medecin
        ) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('suivi.create')
            && $user->medecin !== null;
    }

    public function update(User $user, Suivi $suivi): bool
    {
        // Admin
        if ($user->hasRole('admin')) {
            return true;
        }

        // Médecin: uniquement ses propres suivis
        return
            $user->hasPermission('suivi.update') &&
            $user->medecin !== null &&
            $suivi->id_medecin === $user->medecin->id_medecin;
    }

    public function delete(User $user, Suivi $suivi): bool
    {
        return false;
    }

    public function restore(User $user, Suivi $suivi): bool
    {
        return false;
    }

    public function forceDelete(User $user, Suivi $suivi): bool
    {
        return false;
    }
}