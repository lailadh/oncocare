<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class LaratrustSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrateur',
                'description' => 'Gestion complète de la plateforme',
            ],
            [
                'name' => 'medecin',
                'display_name' => 'Médecin',
                'description' => 'Gestion et suivi des patients',
            ],
            [
                'name' => 'patient',
                'display_name' => 'Patient',
                'description' => 'Consultation de son suivi et de ses rendez-vous',
            ],
            [
                'name' => 'proche',
                'display_name' => 'Proche',
                'description' => 'Accès aux informations autorisées',
            ],
        ];

        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );
        }
    }
}