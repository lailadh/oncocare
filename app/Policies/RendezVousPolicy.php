<?php

namespace App\Policies;

use App\Models\RendezVous;
use App\Models\User;
use App\Models\AutorisationProche;

class RendezVousPolicy
{
    /**
     * Qui peut consulter une liste de rendez-vous ?
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            'medecin',
            'patient',
            'proche',
        ]);
    }

    /**
     * Consulter un rendez-vous précis.
     */
    public function view(User $user, RendezVous $rendezVous): bool
    {
        // Patient : uniquement ses propres rendez-vous
        if ($user->role === 'patient' && $user->patient) {
            return $rendezVous->id_patient === $user->patient->id_patient;
        }

        // Médecin : uniquement ses propres rendez-vous
        if ($user->role === 'medecin' && $user->medecin) {
            return $rendezVous->id_medecin === $user->medecin->id_medecin;
        }

        // Proche : uniquement si le patient l'a autorisé
        if ($user->role === 'proche') {
            return AutorisationProche::where('id_proche', $user->id)
                ->where('id_patient', $rendezVous->id_patient)
                ->where('statut', 'active')
                ->where('acces_rendez_vous', true)
                ->exists();
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
     * Traiter uniquement les demandes appartenant au médecin connecté.
     */
    public function update(User $user, RendezVous $rendezVous): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $rendezVous->id_medecin === $user->medecin->id_medecin;
    }

    /**
     * Seul le médecin propriétaire du rendez-vous peut le supprimer.
     */
    public function delete(User $user, RendezVous $rendezVous): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $rendezVous->id_medecin === $user->medecin->id_medecin;
    }

    /**
     * La restauration n'est pas autorisée.
     */
    public function restore(User $user, RendezVous $rendezVous): bool
    {
        return false;
    }

    /**
     * La suppression définitive n'est pas autorisée.
     */
    public function forceDelete(User $user, RendezVous $rendezVous): bool
    {
        return false;
    }
}
