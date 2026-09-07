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
        Schema::create('rendez_vous', function (Blueprint $table) {
      $table->id('id_rendez_vous');

            $table->dateTime('date_heure');
            $table->string('statut');
            $table->string('motif')->nullable();

            $table->foreignId('id_patient')
                ->constrained('patients', 'id_patient')
                ->cascadeOnDelete();

            $table->foreignId('id_medecin')
                ->constrained('medecins', 'id_medecin')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};
