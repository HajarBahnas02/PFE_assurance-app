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
        Schema::create('devis_garanties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garantie_id')->constrained('type_garanties');
            $table->foreignId('devis_id')->constrained('devis');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis_garanties');
    }
};
