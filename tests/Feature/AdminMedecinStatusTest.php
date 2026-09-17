<?php

namespace Tests\Feature;

use App\Models\Medecin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMedecinStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_activate_medecin_without_resending_speciality(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'statut' => 'active',
        ]);

        $medecin = User::factory()->create([
            'role' => 'medecin',
            'statut' => 'en_attente',
            'prenom' => 'Sofia',
            'nom' => 'Dahmani',
            'email' => 'sofia@example.com',
        ]);

        Medecin::create([
            'id_utilisateur' => $medecin->id,
            'specialite' => 'Oncologie médicale',
        ]);

        $response = $this->actingAs($admin)
            ->patch(route('admin.users.update', $medecin), [
                'role' => 'medecin',
                'statut' => 'active',
            ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $medecin->id,
            'role' => 'medecin',
            'statut' => 'active',
        ]);
    }
}
