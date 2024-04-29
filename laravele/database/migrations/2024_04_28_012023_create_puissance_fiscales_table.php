<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('puissance_fiscale', function (Blueprint $table) {
            $table->id();
            $table->integer('PuissFiscale');
            $table->timestamps();
        });

        // Remplir la table avec les valeurs de PuissFiscale de 1 à 100
        for ($i = 1; $i <= 100; $i++) {
            DB::table('puissance_fiscale')->insert([
                'PuissFiscale' => $i,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puissance_fiscales');
    }
};
