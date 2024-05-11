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
        Schema::create('administrateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('cin');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->string('password');
            $table->tinyInteger('role')->default(1);
            $table->timestamps();
        });
        DB::table('administrateurs')->insert([
            'nom' => 'administateur',
            'prenom' => 'admin',
            'cin' => 'CB342882',
            'email' => 'admin@example.com',
            'telephone' => '0123456789',
            'password' => bcrypt('tanjiro'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrateurs');
    }
};
