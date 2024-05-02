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
        Schema::create('option_garanties', function (Blueprint $table) {
            $table->id();
            $table->integer('valeur');
            $table->string('nom');
            $table->timestamps();
        });
        $option_garanties = [
            ['valeur' => 10, 'nom' => '10% avec minimum 2500 dhs'],
            ['valeur' => 10, 'nom' => '10% avec minimum 5000 dhs'],
            ['valeur' => 15, 'nom' => '15% avec minimum 10000 dhs'],
            ['valeur' => 15, 'nom' => '15% avec minimum 4000 dhs'],
            ['valeur' => 20, 'nom' => '20% avec minimum 10000 dhs'],
            ['valeur' => 20, 'nom' => '20% avec minimum 4000 dhs'],
            ['valeur' => 3, 'nom' => '3% avec minimum 5000 dhs'],
            ['valeur' => 3, 'nom' => '3% avec minimum 2500 dhs'],
            ['valeur' => 5, 'nom' => '5% avec minimum 2500 dhs'],
            ['valeur' => 5, 'nom' => '5% avec minimum 5000 dhs'],

        ];
            DB::table('option_garanties')->insert($option_garanties);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_garanties');
    }
};
