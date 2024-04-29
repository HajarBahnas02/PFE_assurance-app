<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assistances', function (Blueprint $table) {
            $table->id()->p;
            $table->string('nomAssistance');
            $table->string('OptionAssistance')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        DB::table('assistances')->insert([
            'id' => 1,'nomAssistance' => 'Assistance Complémantaire',
            'id' => 2,'nomAssistance' => 'Assistance Complémantaire Prémium',
        ]);

    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistances');
    }
};
