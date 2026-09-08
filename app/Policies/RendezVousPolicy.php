<?php

namespace App\Policies;

use App\Models\RendezVous;
use App\Models\User;

class RendezVousPolicy
{
    /**
     * Patient et médecin peuvent consulter leurs rendez-vous.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['medecin', 'patient']);
    }

    /**
     * Voir un rendez-vous.
     */
    public function view(User $user, RendezVous $rendezVous): bool
    {
        // Patient : uniquement ses rendez-vous
        if ($user->role === 'patient' && $user->patient) {
            return $rendezVous->id_patient == $user->patient->id_patient;
        }

        // Médecin : uniquement ses rendez-vous
        if ($user->role === 'medecin' && $user->medecin) {
            return $rendezVous->id_medecin == $user->medecin->id_medecin;
        }

        return false;
    }

    /**
     * Créer un rendez-vous : patient uniquement.
     */
    public function create(User $user): bool
    {
        return $user->role === 'patient'
            && $user->patient !== null;
    }

    /**
     * Modifier un rendez-vous : médecin concerné uniquement.
     */
    public function update(User $user, RendezVous $rendezVous): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $rendezVous->id_medecin == $user->medecin->id_medecin;
    }

    /**
     * Suppression : médecin concerné uniquement.
     */
    public function delete(User $user, RendezVous $rendezVous): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $rendezVous->id_medecin == $user->medecin->id_medecin;
    }

    public function restore(User $user, RendezVous $rendezVous): bool
    {
        return false;
    }

    public function forceDelete(User $user, RendezVous $rendezVous): bool
    {
        return false;
    }
}