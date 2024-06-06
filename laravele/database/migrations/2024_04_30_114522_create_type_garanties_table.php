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
        Schema::create('type_garanties', function (Blueprint $table) {
            $table->id();
            $table->string('nomTypeGarantie');
            $table->text('description')->nullable();
            $table->string('VideoTypeGarantie')->nullable();
            $table->decimal('prix', 10, 2);
            $table->timestamps();
        });

        // Insert sample data into type_garanties table
        $garanties = [
            'Responsabilité civile',
            'Evenements catastrophiques adossée à la RC',
            'Protection Juridique',
            'Protection du Conducteur et des Passagers',
            'Evenements catastrophiques adossée aux GA',
            'Vol',
            'Incendie',
            'Bris de glaces',
            'Collision',
            'Dommages au véhicule',
        ];

        foreach ($garanties as $garantie) {
            DB::table('type_garanties')->insert([
                'nomTypeGarantie' => $garantie,
                'prix' => 50, 
                'description' => null,
                'VideoTypeGarantie' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_garanties');
    }
};
