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
            $table->unsignedBigInteger('modele_id');
            $table->foreign('modele_id')->references('id')->on('modeles')->onDelete('cascade');    
            // Clé étrangère pour la relation avec la table "type_motorisations"
            $table->unsignedBigInteger('type_motorisation_id');
            $table->foreign('type_motorisation_id')->references('id')->on('type_motorisations')->onDelete('cascade');
           // Clé étrangère pour la relation avec la table "marques"
           $table->unsignedBigInteger('marque_id');
           $table->foreign('marque_id')->references('id')->on('marques')->onDelete('cascade');
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
