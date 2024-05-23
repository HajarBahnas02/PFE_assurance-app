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
                $table->id('id');
                $table->string('nomOffre'); 
                $table->decimal('montant_offre', 10, 2)->default("0"); 
                $table->timestamps(); 
                });
                DB::table('offres')->insert([
                    [ 'nomOffre' => 'Formule initiale' , 'created_at' => now(),
                    'updated_at' => now()],
                    ['nomOffre' => 'Formule essentielle','created_at' => now(),
                    'updated_at' => now()],
                    ['nomOffre' => 'Formule premium','created_at' => now(),
                    'updated_at' => now()],      ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
