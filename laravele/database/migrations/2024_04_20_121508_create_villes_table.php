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
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('nomVille');
            $table->timestamps();
        });
        
        $villes = [
            ["nomVille" => "Agadir"],
            ["nomVille" => "Al Hoceima"],
            ["nomVille" => "Al kelaa des Sraghna"],
            ["nomVille" => "Azilal"],
            ["nomVille" => "Ben Slimane"],
            ["nomVille" => "Béni mellal"],
            ["nomVille" => "Boujdour"],
            ["nomVille" => "Boulemane"],
            ["nomVille" => "Casablanca"],
            ["nomVille" => "Chefchaouen"],
            ["nomVille" => "Chichaoua"],
            ["nomVille" => "Dakhla"],
            ["nomVille" => "Efrane"],
            ["nomVille" => "El jadida"],
            ["nomVille" => "Errachidia"],
            ["nomVille" => "Es Semara"],
            ["nomVille" => "Essaouirra"],
            ["nomVille" => "Fès"],
            ["nomVille" => "Figuig"],
            ["nomVille" => "Guelmim"],
            ["nomVille" => "Kénitra"],
            ["nomVille" => "Khémisset"],
            ["nomVille" => "Khénifra"],
            ["nomVille" => "Khouribga"],
            ["nomVille" => "Laâyoune"],
            ["nomVille" => "Larache"],
            ["nomVille" => "Marrakech"],
            ["nomVille" => "Meknès"],
            ["nomVille" => "Mohammédia"],
            ["nomVille" => "Nador"],
            ["nomVille" => "Ouarzazate"],
            ["nomVille" => "Oujda"],
            ["nomVille" => "Rabat"],
            ["nomVille" => "Safi"],
            ["nomVille" => "Salé"],
            ["nomVille" => "Sefrou"],
            ["nomVille" => "Settat"],
            ["nomVille" => "Sidi Kacem"],
            ["nomVille" => "Tan Tan"],
            ["nomVille" => "Tanger"],
            ["nomVille" => "Taounate"],
            ["nomVille" => "Taroudannt"],
            ["nomVille" => "Tata"],
            ["nomVille" => "Taza"],
            ["nomVille" => "Témara"],
            ["nomVille" => "Tétouan"],
            ["nomVille" => "Tiznit"]
        ];

        $now = now()->toDateTimeString(); // Utilisez toDateTimeString() pour inclure également l'heure
        $villesWithTimestamps = array_map(function ($ville) use ($now) {
            return [
                'nomVille' => $ville['nomVille'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $villes);

        DB::table('villes')->insert($villesWithTimestamps);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villes');
    }
};
