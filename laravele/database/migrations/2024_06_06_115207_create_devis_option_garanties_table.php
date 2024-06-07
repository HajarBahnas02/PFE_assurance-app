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
    Schema::create('devis_option_garanties', function (Blueprint $table) {
        $table->id();
        $table->foreignId('devis_garantie_id')->constrained('devis_garanties')->onDelete('cascade');
        $table->foreignId('option_garantie_id')->constrained('option_garanties')->onDelete('cascade');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis_option_garanties');
    }
};
