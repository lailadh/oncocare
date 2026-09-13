<?php

namespace App\Policies;

use App\Models\Suivi;
use App\Models\User;
use App\Models\AutorisationProche;

class SuiviPolicy
{
    /**
     * Qui peut consulter la liste des suivis ?
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
     * Afficher un suivi précis.
     */
    public function view(User $user, Suivi $suivi): bool
    {
        // Médecin : uniquement ses propres suivis
        if ($user->role === 'medecin' && $user->medecin) {
            return $suivi->id_medecin === $user->medecin->id_medecin;
        }

        // Patient : uniquement ses propres suivis
        if ($user->role === 'patient' && $user->patient) {
            return $suivi->id_patient === $user->patient->id_patient;
        }

        // Proche : uniquement si le patient l'a autorisé
        if ($user->role === 'proche') {
            return AutorisationProche::where('id_proche', $user->id)
                ->where('id_patient', $suivi->id_patient)
                ->where('statut', 'active')
                ->where('acces_suivi', true)
                ->exists();
        }

        return false;
    }

    /**
     * Création d'un suivi : médecin uniquement.
     */
    public function create(User $user): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null;
    }

    /**
     * Modification d'un suivi :
     * médecin uniquement et uniquement ses propres suivis.
     */
    public function update(User $user, Suivi $suivi): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $suivi->id_medecin === $user->medecin->id_medecin;
    }

    /**
     * Suppression d'un suivi :
     * médecin uniquement et uniquement ses propres suivis.
     */
    public function delete(User $user, Suivi $suivi): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $suivi->id_medecin === $user->medecin->id_medecin;
    }

    /**
     * La restauration n'est pas autorisée.
     */
    public function restore(User $user, Suivi $suivi): bool
    {
        return false;
    }

    /**
     * La suppression définitive n'est pas autorisée.
     */
    public function forceDelete(User $user, Suivi $suivi): bool
    {
        return false;
    }
}
