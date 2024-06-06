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
        Schema::create('option_garanties', function (Blueprint $table) {
            $table->id();
            $table->integer('valeur');
            $table->string('nom');
            $table->unsignedBigInteger('garantie_id');
            $table->foreign('garantie_id')->references('id')->on('type_garanties')->onDelete('cascade');
            $table->timestamps();
        });

        // Insert sample data into option_garanties table
        $option_garanties = [
            ['valeur' => 10, 'nom' => '10% avec minimum 2500 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 10, 'nom' => '10% avec minimum 5000 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 15, 'nom' => '15% avec minimum 10000 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 15, 'nom' => '15% avec minimum 4000 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 20, 'nom' => '20% avec minimum 10000 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 20, 'nom' => '20% avec minimum 4000 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 3, 'nom' => '3% avec minimum 5000 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 3, 'nom' => '3% avec minimum 2500 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 5, 'nom' => '5% avec minimum 2500 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['valeur' => 5, 'nom' => '5% avec minimum 5000 dhs', 'garantie_id' => 9, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('option_garanties')->insert($option_garanties);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_garanties');
    }
};
