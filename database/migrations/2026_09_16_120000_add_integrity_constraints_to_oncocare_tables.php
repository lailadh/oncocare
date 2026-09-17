<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('autorisation_proches', function (Blueprint $table): void {
            $table->unique(
                ['id_patient', 'id_proche'],
                'autorisation_proches_patient_proche_unique'
            );
        });

        Schema::table('rendez_vous', function (Blueprint $table): void {
            $table->unique(
                ['id_medecin', 'date_heure'],
                'rendez_vous_medecin_date_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('autorisation_proches', function (Blueprint $table): void {
            $table->dropUnique('autorisation_proches_patient_proche_unique');
        });

        Schema::table('rendez_vous', function (Blueprint $table): void {
            $table->dropUnique('rendez_vous_medecin_date_unique');
        });
    }
};