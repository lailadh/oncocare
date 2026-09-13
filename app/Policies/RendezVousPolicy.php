<?php

namespace App\Policies;

use App\Models\RendezVous;
use App\Models\User;

class RendezVousPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['medecin', 'patient']);
    }

    public function view(User $user, RendezVous $rendezVous): bool
    {
        if ($user->role === 'patient' && $user->patient) {
            return $rendezVous->id_patient == $user->patient->id_patient;
        }

        if ($user->role === 'medecin' && $user->medecin) {
            return $rendezVous->id_medecin == $user->medecin->id_medecin;
        }

        return false;
    }

    /**
     * Seul le médecin peut créer un rendez-vous.
     */
    public function create(User $user): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null;
    }

    /**
     * Seul le médecin propriétaire du rendez-vous peut le supprimer.
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