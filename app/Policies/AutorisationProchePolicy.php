<?php

namespace App\Policies;

use App\Models\AutorisationProche;
use App\Models\User;

class AutorisationProchePolicy
{
    /**
     * Qui peut consulter la liste des autorisations ?
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            'patient',
            'proche',
        ]);
    }

    /**
     * Consulter une autorisation précise.
     */
    public function view(
        User $user,
        AutorisationProche $autorisation
    ): bool {
        // Patient : uniquement ses propres autorisations
        if ($user->role === 'patient' && $user->patient) {
            return $autorisation->id_patient === $user->patient->id_patient;
        }

        // Proche : uniquement ses autorisations actives
        if ($user->role === 'proche') {
            return $autorisation->id_proche === $user->id
                && $autorisation->statut === 'active';
        }

        return false;
    }

    /**
     * Création : patient uniquement.
     */
    public function create(User $user): bool
    {
        return $user->role === 'patient'
            && $user->patient !== null;
    }

    /**
     * Modification : uniquement par le patient propriétaire.
     */
    public function update(
        User $user,
        AutorisationProche $autorisation
    ): bool {
        return $user->role === 'patient'
            && $user->patient !== null
            && $autorisation->id_patient === $user->patient->id_patient;
    }

    /**
     * Suppression : uniquement par le patient propriétaire.
     */
    public function delete(
        User $user,
        AutorisationProche $autorisation
    ): bool {
        return $user->role === 'patient'
            && $user->patient !== null
            && $autorisation->id_patient === $user->patient->id_patient;
    }
}
