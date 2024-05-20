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
            $table->string('email')->unique();
            $table->date('date_naissance');
            $table->string('telephone')->unique(); 
            $table->foreignId('ville_id')->constrained('villes');
            $table->string('cin')->unique()->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
            $table->tinyInteger('role')->default(0);
        });

        DB::table('clients')->insert([
            'nom' => 'user',
            'prenom' => 'admin',
            'date_naissance' => '1999-05-07',
            'cin' => 'CB342881',
            'email' => 'user@example.com',
            'telephone' => '+212650359007',
            'password' => bcrypt('root'),
            'ville_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'nom' => 'tanjiro',
            'prenom' => 'tan',
            'cin' => 'CB342883',
            'date_naissance' => '1999-05-07',
            'email' => 'tanjiro@example.com',
            'telephone' => '06286328',
            'password' => bcrypt('root'), 
            'ville_id' =>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'nom' => 'nezuko',
            'prenom' => 'kam',
            'cin' => 'CB342884',
            'date_naissance' => '1999-05-07',
            'email' => 'bahnashajar@gmail.com',
            'telephone' => '0474723',
            'password' => bcrypt('root'),
            'ville_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'nom' => 'inuske',
            'prenom' => 'hajar',
            'cin' => 'CB342887',
            'date_naissance' => '1999-05-07',

            'email' => 'boucchrabahnas@gmail.com',
            'telephone' => '04747023',
            'password' => bcrypt('root'), 
            'ville_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('clients')->insert([
            'nom' => 'bhs',
            'prenom' => 'hajar',
            'cin' => 'CB342888',
            'date_naissance' => '1999-05-07',
            'email' => 'hajar.bahnas@usmba.ac.ma',
            'telephone' => '04747909',
            'password' => bcrypt('root'), 
            'ville_id' => 1,
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
