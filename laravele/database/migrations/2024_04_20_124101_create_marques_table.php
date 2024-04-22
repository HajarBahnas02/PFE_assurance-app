<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marques', function (Blueprint $table) {
            $table->id();
            $table->string('nomMarque');
            $table->timestamps();
        });

        $marques = [
            'Toyota',
            'Honda',
            'Ford',
            'Volkswagen',
            'BMW',
            'Mercedes-Benz',
            'Audi',
            'Nissan',
            'Chevrolet',
            'Hyundai',
            'Kia',
            'Subaru',
            'Tesla',
            'Lexus',
            'Mazda',
            ''
        ];

        $now = now()->toDateTimeString();

        $marquesData = array_map(function ($marque) use ($now) {
            return [
                'nomMarque' => $marque,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $marques);

        DB::table('marques')->insert($marquesData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marques');
    }
};
