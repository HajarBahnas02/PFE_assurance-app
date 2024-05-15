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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('cin')->unique();
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->string('password');
            $table->timestamps();
            $table->tinyInteger('role')->default(0);
        });
        
        DB::table('clients')->insert([
            'nom' => 'user',
            'prenom' => 'admin',
            'cin' => 'CB342881',
            'email' => 'user@example.com',
            'telephone' => '012345789',
            'password' => bcrypt('root'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'nom' => 'tanjiro',
            'prenom' => 'tan',
            'cin' => 'CB342883',
            'email' => 'tanjiro@example.com',
            'telephone' => '06286328',
            'password' => bcrypt('root'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'nom' => 'nezuko',
            'prenom' => 'kam',
            'cin' => 'CB342884',
            'email' => 'user@gamil.com',
            'telephone' => '0474723',
            'password' => bcrypt('root'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'nom' => 'inuske',
            'prenom' => 'hajar',
            'cin' => 'CB342887',
            'email' => 'bahnashajar@gmail.com',
            'telephone' => '04747023',
            'password' => bcrypt('root'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'nom' => 'bhs',
            'prenom' => 'hajar',
            'cin' => 'CB342888',
            'email' => 'hajar.bahnas@usmba.ac.ma',
            'telephone' => '04747909',
            'password' => bcrypt('root'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
