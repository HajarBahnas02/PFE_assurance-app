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
        {
            Schema::create('contrats', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
                $table->string('vehicule_matricule', 50);
                $table->foreign('vehicule_matricule')->references('matricule')->on('vehicules')->onDelete('cascade');
                $table->string('numero_devis')->unique();
                $table->date('date_debut');
                $table->date('date_fin');
                $table->float('montant_assurance');
                $table->string('statut')->default('non-traitee');
                $table->timestamps();
            });
            DB::table('contrats')->insert([
                'client_id' => 1,
                'vehicule_matricule' => 'ABC123',
                'numero_devis' => 'DEV-' . Str::upper(Str::random(10)),
                'date_debut' => '2024-05-15',
                'date_fin' => '2025-05-15',
                'montant_assurance' => 500.00,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('contrats')->insert([
                'client_id' => 4,
                'vehicule_matricule' => 'DEF123',
                'numero_devis' => 'DEV-' . Str::upper(Str::random(10)),
                'date_debut' => '2024-06-15',
                'date_fin' => '2025-09-15',
                'montant_assurance' => 500.00,
                'created_at' => now(),
                'updated_at' => now()
            ]);   
              DB::table('contrats')->insert([
                'client_id' => 5,
                'vehicule_matricule' => 'FGH123',
                'numero_devis' => 'DEV-' . Str::upper(Str::random(10)),
                'date_debut' => '2024-05-15',
                'date_fin' => '2025-02-5',
                'montant_assurance' => 500.00,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
