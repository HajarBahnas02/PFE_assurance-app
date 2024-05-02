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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('nomOffre');
            $table->decimal('montant', 10, 2);
            $table->timestamps();
        });
        DB::table('offres')->insert([
            ['nomOffre' => 'Formule initiale', 'montant' => 0 ,   'created_at' => now(),
            'updated_at' => now()],
            ['nomOffre' => 'Formule essentielle', 'montant' => 0,'created_at' => now(),
            'updated_at' => now()],
            ['nomOffre' => 'Formule premium', 'montant' => 0,'created_at' => now(),
            'updated_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
