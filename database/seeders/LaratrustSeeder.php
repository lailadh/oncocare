<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class LaratrustSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            // Administration
            [
                'name' => 'users.view',
                'display_name' => 'Voir les utilisateurs',
                'description' => 'Consulter la liste des utilisateurs',
            ],
            [
                'name' => 'users.create',
                'display_name' => 'Créer un utilisateur',
                'description' => 'Créer un nouvel utilisateur',
            ],
            [
                'name' => 'users.update',
                'display_name' => 'Modifier un utilisateur',
                'description' => 'Modifier les informations d’un utilisateur',
            ],
            [
                'name' => 'users.delete',
                'display_name' => 'Supprimer un utilisateur',
                'description' => 'Supprimer un utilisateur',
            ],
            [
                'name' => 'roles.manage',
                'display_name' => 'Gérer les rôles',
                'description' => 'Gérer les rôles et leurs permissions',
            ],

            // Médecin
            [
                'name' => 'patients.view',
                'display_name' => 'Voir les patients',
                'description' => 'Consulter les patients associés au médecin',
            ],
            [
                'name' => 'suivi.view',
                'display_name' => 'Voir le suivi',
                'description' => 'Consulter les informations de suivi médical',
            ],
            [
                'name' => 'suivi.create',
                'display_name' => 'Créer un suivi',
                'description' => 'Ajouter une information de suivi',
            ],
            [
                'name' => 'suivi.update',
                'display_name' => 'Modifier le suivi',
                'description' => 'Modifier une information de suivi',
            ],
            [
                'name' => 'rendezvous.view',
                'display_name' => 'Voir les rendez-vous',
                'description' => 'Consulter les rendez-vous',
            ],
            [
                'name' => 'rendezvous.create',
                'display_name' => 'Créer un rendez-vous',
                'description' => 'Créer un rendez-vous',
            ],
            [
                'name' => 'rendezvous.update',
                'display_name' => 'Modifier un rendez-vous',
                'description' => 'Modifier un rendez-vous',
            ],

            // Patient
            [
                'name' => 'rendezvous.create',
                'display_name' => 'Demander un rendez-vous',
                'description' => 'Créer une demande de rendez-vous',
            ],
            [
                'name' => 'rendezvous.update',
                'display_name' => 'Modifier un rendez-vous',
                'description' => 'Modifier ses rendez-vous',
            ],
            [
                'name' => 'proches.manage',
                'display_name' => 'Gérer les proches',
                'description' => 'Gérer les proches autorisés',
            ],

            // Proche
            [
                'name' => 'authorized_data.view',
                'display_name' => 'Voir les informations autorisées',
                'description' => 'Consulter uniquement les informations autorisées par le patient',
            ],
        ];

        foreach ($permissions as $permissionData) {
            Permission::updateOrCreate(
                ['name' => $permissionData['name']],
                $permissionData
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Role → Permissions
        |--------------------------------------------------------------------------
        */

        $admin = Role::where('name', 'admin')->first();
        $medecin = Role::where('name', 'medecin')->first();
        $patient = Role::where('name', 'patient')->first();
        $proche = Role::where('name', 'proche')->first();

        $adminPermissions = Permission::whereIn('name', [
            'users.view',
            'users.create',
            'users.update',
            'users.delete',
            'roles.manage',
        ])->get();

        $medecinPermissions = Permission::whereIn('name', [
            'patients.view',
            'suivi.view',
            'suivi.create',
            'suivi.update',
            'rendezvous.view',
            'rendezvous.create',
            'rendezvous.update',
        ])->get();

        $patientPermissions = Permission::whereIn('name', [
            'suivi.view',
            'rendezvous.view',
            'rendezvous.create',
            'rendezvous.update',
            'proches.manage',
        ])->get();

        $prochePermissions = Permission::whereIn('name', [
            'authorized_data.view',
            'rendezvous.view',
        ])->get();

        $admin->syncPermissions($adminPermissions);
        $medecin->syncPermissions($medecinPermissions);
        $patient->syncPermissions($patientPermissions);
        $proche->syncPermissions($prochePermissions);
    }
}