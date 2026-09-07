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
    Schema::create('suivre', function (Blueprint $table) {
        $table->foreignId('id_patient')
            ->constrained('patients', 'id_patient')
            ->cascadeOnDelete();

        $table->foreignId('id_medecin')
            ->constrained('medecins', 'id_medecin')
            ->cascadeOnDelete();

        $table->primary(['id_patient', 'id_medecin']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivre');
    }
};
