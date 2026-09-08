<?php

namespace App\Policies;

use App\Models\Suivi;
use App\Models\User;

class SuiviPolicy
{
    /**
     * Médecin: يمكنو يشوف suivis ديالو.
     * Patient: يمكنو يشوف suivis ديالو.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['medecin', 'patient']);
    }

    /**
     * عرض suivi واحد.
     */
    public function view(User $user, Suivi $suivi): bool
    {
        // Médecin: غير suivis ديالو
        if ($user->role === 'medecin' && $user->medecin) {
            return $suivi->id_medecin == $user->medecin->id_medecin;
        }

        // Patient: غير suivis ديالو
        if ($user->role === 'patient' && $user->patient) {
            return $suivi->id_patient == $user->patient->id_patient;
        }

        return false;
    }

    /**
     * إنشاء suivi: médecin فقط.
     */
    public function create(User $user): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null;
    }

    /**
     * تعديل suivi: médecin فقط و suivi ديالو.
     */
    public function update(User $user, Suivi $suivi): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $suivi->id_medecin == $user->medecin->id_medecin;
    }

    /**
     * حذف suivi: médecin فقط و suivi ديالو.
     */
    public function delete(User $user, Suivi $suivi): bool
    {
        return $user->role === 'medecin'
            && $user->medecin !== null
            && $suivi->id_medecin == $user->medecin->id_medecin;
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