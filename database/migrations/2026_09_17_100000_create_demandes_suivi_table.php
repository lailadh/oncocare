<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes_suivi', function (Blueprint $table) {
            $table->id('id_demande');

            $table->string('statut')->default('en_attente');
            $table->date('date_demande');
            $table->dateTime('date_traitement')->nullable();

            $table->foreignId('id_patient')
                ->constrained('patients', 'id_patient')
                ->cascadeOnDelete();

            $table->foreignId('id_medecin')
                ->constrained('medecins', 'id_medecin')
                ->cascadeOnDelete();

            $table->index(['id_patient', 'id_medecin']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes_suivi');
    }
};
