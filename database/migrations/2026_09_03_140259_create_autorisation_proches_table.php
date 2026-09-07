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
        Schema::create('autorisation_proches', function (Blueprint $table) {
            $table->id('id_autorisation');

            $table->boolean('acces_suivi')->default(false);
            $table->boolean('acces_rendez_vous')->default(false);

            $table->string('statut');
            $table->date('date_autorisation');

            $table->foreignId('id_patient')
                ->constrained('patients', 'id_patient')
                ->cascadeOnDelete();

            $table->foreignId('id_proche')
                ->constrained('users', 'id')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorisation_proches');
    }
};
