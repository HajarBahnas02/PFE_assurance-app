<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('garanties_selectionnees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->constrained('offres');
            $table->foreignId('garantie_id')->constrained('type_garanties');
            $table->timestamps();
        });

        $associations = [
            1 => [1, 2, 3, 4], // Offre d'id 1 correspondant aux garanties 1, 2, 3, 4
            2 => [1, 2, 3, 4, 5, 6, 7, 8, 9], // Offre d'id 2 correspondant aux garanties 1 à 9
            3 => [1, 2, 3, 4, 5, 6, 7, 8, 9], // Offre d'id 3 correspondant aux garanties 1 à 9
        ];
        
        // Construire un tableau de données pour l'insertion
        $data = [];
        
        foreach ($associations as $offreId => $garantieIds) {
            foreach ($garantieIds as $garantieId) {
                $data[] = [
                    'offre_id' => $offreId,
                    'garantie_id' => $garantieId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        // Insérer les données dans la table garanties_selectionnees
        DB::table('garanties_selectionnees')->insert($data);

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garanties_selectionnees');
    }
};
