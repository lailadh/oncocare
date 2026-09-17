<?php

namespace App\Policies;

use App\Models\DemandeSuivi;
use App\Models\User;

class DemandeSuiviPolicy
{
    /**
     * Qui peut consulter la liste des demandes de suivi ?
     *
     * Le patient consulte ses propres demandes,
     * le médecin consulte les demandes reçues.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            'patient',
            'medecin',
        ]);
    }

    /**
     * Afficher une demande de suivi précise.
     *
     * Le patient ne voit que ses propres demandes,
     * le médecin uniquement les demandes reçues.
     */
    public function view(User $user, DemandeSuivi $demandeSuivi): bool
    {
        if ($user->role === 'patient' && $user->patient) {
            return $demandeSuivi->id_patient === $user->patient->id_patient;
        }

        if ($user->role === 'medecin' && $user->medecin) {
            return $demandeSuivi->id_medecin === $user->medecin->id_medecin;
        }

        return false;
    }

    /**
     * Création d'une demande de suivi : patient uniquement.
     */
    public function create(User $user): bool
    {
        return $user->role === 'patient'
            && $user->patient !== null;
    }

    /**
     * Traitement d'une demande (acceptation / refus) :
     * médecin destinataire uniquement.
     */
    public function update(User $user, DemandeSuivi $demandeSuivi): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $demandeSuivi->id_medecin === $user->medecin->id_medecin;
    }

    /**
     * La suppression n'est pas autorisée côté applicatif.
     */
    public function delete(User $user, DemandeSuivi $demandeSuivi): bool
    {
        return false;
    }
}
