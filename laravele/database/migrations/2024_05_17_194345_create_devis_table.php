<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('matricule', 50);
            $table->foreign('matricule')->references('matricule')->on('vehicules')->onDelete('cascade');
            $table->string('numero_devis')->unique();
            $table->decimal('montant_initial', 10, 2)->default(0);
            $table->decimal('montant_essentiel', 10, 2)->default(0);
            $table->decimal('montant_premium', 10, 2)->default(0);
            $table->date('date_debut');
            $table->timestamps();
        });
        DB::table('devis')->insert([
            'client_id' => 5,
            'matricule' => 'FGH123',
            'numero_devis' => 'DEV-' . Str::upper(Str::random(10)),
            'date_debut' => '2024-05-15',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('devis')->insert([
            'client_id' => 3,
            'matricule' => 'DEF123',
            'numero_devis' => 'DEV-' . Str::upper(Str::random(10)),
            'date_debut' => '2024-05-15',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};
