<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Reset des données de démonstration
        |--------------------------------------------------------------------------
        | On conserve les comptes admin.
        |--------------------------------------------------------------------------
        */

        Schema::disableForeignKeyConstraints();

        DB::table('notifications')->truncate();
        DB::table('demandes_suivi')->truncate();
        DB::table('autorisation_proches')->truncate();
        DB::table('rendez_vous')->truncate();
        DB::table('suivis')->truncate();
        DB::table('suivre')->truncate();

        DB::table('patients')->truncate();
        DB::table('medecins')->truncate();

        DB::table('users')
            ->where('role', '!=', 'admin')
            ->delete();

        Schema::enableForeignKeyConstraints();

        $this->command?->info('');
        $this->command?->info('==============================================');
        $this->command?->info('       BASE ONCOCARE NETTOYEE');
        $this->command?->info('==============================================');
        $this->command?->info('Comptes admin conservés : oui');
        $this->command?->info('Médecins : 0');
        $this->command?->info('Patients : 0');
        $this->command?->info('Proches : 0');
        $this->command?->info('Suivis : 0');
        $this->command?->info('Demandes de suivi : 0');
        $this->command?->info('Rendez-vous : 0');
        $this->command?->info('Autorisations : 0');
        $this->command?->info('Notifications : 0');
        $this->command?->info('');
        $this->command?->info('La base est maintenant prête pour un remplissage manuel étape par étape.');
        $this->command?->info('==============================================');
    }
}
