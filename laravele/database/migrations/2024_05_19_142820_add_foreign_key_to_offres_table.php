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
    public function up()
    {
        Schema::table('offres', function (Blueprint $table) {
            // Assurez-vous que la table 'devis' existe déjà
            if (Schema::hasTable('devis')) {
                // Ajouter la colonne devis_id si elle n'existe pas
                if (!Schema::hasColumn('offres', 'devis_id')) {
                    $table->unsignedBigInteger('devis_id')->after('id')->default("1"); // Ajout de la colonne devis_id
                }

                // Ajouter la contrainte de clé étrangère
                $table->foreign('devis_id')->references('id')->on('devis')->onDelete('cascade');
            }
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->dropForeign(['devis_id']);
            $table->dropColumn('devis_id');
        });
        /*
        DB::table('offres')->insert([
            ['nomOffre' => 'Formule initiale' ,'id_devis'=>1,   'created_at' => now(),
            'updated_at' => now()],
            ['nomOffre' => 'Formule essentielle', 'id_devis'=>1,'created_at' => now(),
            'updated_at' => now()],
            ['nomOffre' => 'Formule premium','id_devis'=>1,'created_at' => now(),
            'updated_at' => now()],
        ]);*/
    }
};
