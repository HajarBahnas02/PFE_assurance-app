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
        Schema::create('montants_proposes', function (Blueprint $table) {
            $table->id();
            $table->string('vehicule_id')->constrained('vehicules');
            $table->decimal('montant_initial', 10, 2)->default(0);
            $table->decimal('montant_essentiel', 10, 2)->default(0);
            $table->decimal('montant_premium', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('montant__proposes');
    }
};
