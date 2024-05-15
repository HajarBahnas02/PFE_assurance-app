<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('montantsProposes', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->constrained();
            $table->decimal('montant_initial', 10, 2)->default(0);
            $table->decimal('montant_essentiel', 10, 2)->default(0);
            $table->decimal('montant_premium', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('montantsProposes');
    }
};