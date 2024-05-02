<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->string('matricule',50)->primary();
            $table-> integer('puissanceFiscale')->unsigned()->check('puissanceFiscale BETWEEN 1 AND 100');
            $table->date('dateMiseEnCirculation'); 
            $table->float('valeurNeuve');
            $table->float('valeurVenale');
            $table->foreignId('modele_id')->constrained('modeles');
            $table->foreignId('type_motorisation_id')->constrained('type_motorisations');
            $table->foreignId('marque_id')->constrained('marques');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
