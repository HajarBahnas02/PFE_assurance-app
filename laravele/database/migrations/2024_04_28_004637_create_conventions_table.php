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
        Schema::create('conventions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('surnom')->nullable()->default(null);;
            $table->timestamps();
        });
        DB::table('conventions')->insert([
            ['nom' => 'Assur auto WW'],
            ['nom' => 'Adhérents fondation med VI'],
            ['nom' => 'assur auto famille (Z3,1)'],
            ['nom' => 'Fidélité (Z3,1)'],
            ['nom' => 'assur auto TPE (Z3,1)'],
            ['nom' => 'ASSUR AUTO LIL MOUADDAF (Z3)'],
            ['nom' => 'Covention clients CDM (V1)'],
            ['nom' => 'Professionnels de la sante (V2)'],
            ['nom' => 'Covention des préposés religieux'],
            ['nom' => 'convention Gendarmerie Royal (V3)'],
            ['nom' => 'Convention COS ONE (V3)'],
            ['nom' => 'convention ministere de la justice (V4)'],
            ['nom' => 'Fos du personnel M.E.F (V1)'],
            ['nom' => 'covention IFA (V1)'],
            ['nom' => 'CONVENTION SALARIES DGSN (V4)'],
            ['nom' => 'ASSUR AUTO LIL MOUADDAF RABAT (Z3)'],
            ['nom' => 'Assur auto LHEMZA'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conventions');
    }
};
