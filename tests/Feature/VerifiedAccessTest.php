<?php

namespace Tests\Feature;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerifiedAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_unverified_patient_can_access_patient_routes_after_verification_removed(): void
    {
        $user = User::factory()
            ->unverified()
            ->create([
                'role' => 'patient',
            ]);

        Patient::create([
            'id_utilisateur' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/patient/suivis');

        $response->assertOk();
    }

    public function test_verified_patient_can_reach_the_medical_route_authorization_boundary(): void
    {
        $user = User::factory()->create([
            'role' => 'patient',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/patient/suivis');

        $response->assertForbidden();
    }
}
