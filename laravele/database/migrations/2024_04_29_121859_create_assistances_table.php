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
        Schema::create('assistances', function (Blueprint $table) {
            $table->id();
            $table->string('nomAssistance');
          
            $table->timestamps();
        });
          
            $data=[
                ['id' => 1,'nomAssistance' => 'Assistance Complémentaire'],
                ['id' => 2,'nomAssistance' => 'Assistance Complémentaire Prémium']];
            DB::table('assistances')->insert($data);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('assistances');
     }
};
