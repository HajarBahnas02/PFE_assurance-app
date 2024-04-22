<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('type_motorisations', function (Blueprint $table) {
            $table->id();
            $table->string('typeM');
            $table->timestamps();
        });


        $type_motorisations = [
            ['typeM' => 'Diesel'],
            ['typeM' => 'Essence'],
            ['typeM' => 'Electrique'],
            ['typeM' => 'Hybride_E'],
            ['typeM' => 'Hybride_D'],

        ];

        $now = now()->toDateTimeString();


        $type = array_map(function ($type_motorisations) use ($now) {

            return [
                'typeM' => $type_motorisations['typeM'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $type_motorisations);

        
        DB::table('type_motorisations')->insert($type);

    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_motorisations');
    }
};
