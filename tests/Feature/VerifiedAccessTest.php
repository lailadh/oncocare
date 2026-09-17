<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerifiedAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_unverified_patient_is_redirected_to_email_verification_before_medical_routes(): void
    {
        $user = User::factory()
            ->unverified()
            ->create([
                'role' => 'patient',
            ]);

        $response = $this
            ->actingAs($user)
            ->get('/patient/suivis');

        $response->assertRedirect(route('verification.notice'));
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
