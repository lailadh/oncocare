<?php

namespace Tests\Unit;

use App\Models\Medecin;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class RendezVousPolicyTest extends TestCase
{
    public function test_active_medecin_can_update_an_appointment_they_own(): void
    {
        $user = $this->medecinUser(7);
        $rendezVous = new RendezVous([
            'id_medecin' => 7,
        ]);

        $this->assertTrue(Gate::forUser($user)->allows('update', $rendezVous));
    }

    public function test_medecin_cannot_update_an_appointment_owned_by_another_medecin(): void
    {
        $user = $this->medecinUser(7);
        $rendezVous = new RendezVous([
            'id_medecin' => 8,
        ]);

        $this->assertFalse(Gate::forUser($user)->allows('update', $rendezVous));
    }

    public function test_patient_cannot_update_an_appointment(): void
    {
        $user = User::make([
            'role' => 'patient',
        ]);
        $rendezVous = new RendezVous([
            'id_medecin' => 7,
        ]);

        $this->assertFalse(Gate::forUser($user)->allows('update', $rendezVous));
    }

    private function medecinUser(int $medecinId): User
    {
        $user = User::make([
            'role' => 'medecin',
        ]);
        $user->setRelation('medecin', Medecin::make([
            'id_medecin' => $medecinId,
        ]));

        return $user;
    }
}
