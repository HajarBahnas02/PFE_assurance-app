<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('statut')->default('non-traitee');
            $table->timestamps();
        });
    
        DB::table('vehicules')->insert([
            'matricule' => 'ABC123',
            'puissanceFiscale' => 10,
            'dateMiseEnCirculation' => '2023-05-14',
            'valeurNeuve' => 30000.00,
            'valeurVenale' => 20000.00,
            'modele_id' => 1,
            'type_motorisation_id' => 1,
            'marque_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('vehicules')->insert([
            'matricule' => 'DEF123',
            'puissanceFiscale' => 11,
            'dateMiseEnCirculation' => '2023-05-14',
            'valeurNeuve' => 30000.00,
            'valeurVenale' => 20000.00,
            'modele_id' => 1,
            'type_motorisation_id' => 1,
            'marque_id' => 1,
            'statut'=>'traitee',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('vehicules')->insert([
            'matricule' => 'FGH123',
            'puissanceFiscale' => 01,
            'dateMiseEnCirculation' => '2023-05-14',
            'valeurNeuve' => 3000.00,
            'valeurVenale' => 2000.00,
            'modele_id' => 1,
            'type_motorisation_id' => 1,
            'marque_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
