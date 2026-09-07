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
        Schema::create('suivis', function (Blueprint $table) {
            $table->id('id_suivi');

            $table->date('date_suivi');

            $table->string('type_cancer')->nullable();
            $table->string('stade')->nullable();
            
            $table->text('observation')->nullable();
            $table->text('evolution')->nullable();
            $table->text('traitement')->nullable();

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
        Schema::dropIfExists('suivis');
    }
};
