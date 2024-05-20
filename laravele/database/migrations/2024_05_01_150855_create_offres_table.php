<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
 
    public function up(): void
    {
       
            Schema::create('offres', function (Blueprint $table) {
                $table->id('id'); // Clé primaire
                $table->string('nomOffre'); // Nom de l'offre
                $table->decimal('montant_offre', 10, 2)->default("0"); // Montant de l'offre
                $table->timestamps(); // Colonnes created_at et updated_at
                });
        
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
