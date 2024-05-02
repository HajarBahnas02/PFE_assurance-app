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
        Schema::create('option_assistances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assistance_id')->constrained('assistances');
            $table->string('nomOptionAssistance');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        $data = [
            [ 'nomOptionAssistance' => 'Mourih','assistance_id'=> 1,'description' => "En cas d’accident : Remorquage en illimité sans franchise kilométrique jusqu’au garage du choix de l’assuré. En cas de panne : Remorquage sans franchise kilométrique jusqu’au garage le plus proche du domicile de l’assuré (1 fois par an)." ],
            [ 'nomOptionAssistance' => 'Mourih 15-20','assistance_id'=> 1, 'description' => null ],
            [ 'nomOptionAssistance' => 'Chamil', 'assistance_id'=> 1,'description' => "En cas d’accident : Remorquage en illimité sans franchise kilométrique jusqu’au garage du choix de l’assuré. Véhicule de remplacement : 6 jrs catégorie équivalente (max C) (2 fois par an) ou 9 jrs catégorie A (2 fois par an). En cas de panne : Remorquage avec franchise kilométrique jusqu’au garage le plus proche du domicile de l’assuré (3 fois par an). Véhicule de remplacement : 3jrs catégorie (1 fois par an)." ],
            [ 'nomOptionAssistance' => 'Chamil15-20','assistance_id'=> 1, 'description' => null ],
            [ 'nomOptionAssistance' => 'Premium', 'assistance_id'=> 2,'description' => "En cas d’accident : Remorquage en illimité pour véhicule immobilisé sans franchise kilométrique jusqu’au garage du choix de l’assuré. Si véhicule roulant en périmètre urbain : Remorquage vers le garage du choix de l’assuré Véhicule de courtoisie avec chauffeur sur le lieu du sinistre pour accompagner l’assuré sur 2courses ; Véhicule de remplacement : 10jrs catégorie équivalente (max D) (3fois par an) 15 jrs catégorie A (3 fois par an), le véhicule est livré à l’assuré dans les deux heures qui suivent le sinistre puis récupération à son domicile ou son lieu de travail ; En cas de panne : Remorquage sans franchise kilométrique jusqu’au garage le plus proche du domicile de l’assuré (3 fois par an). Véhicule de remplacement : 5jrs catégorie A (1 fois par an)." ],
            ['nomOptionAssistance'=> 'Premium VHR+','assistance_id'=> 2,'description'=>null]
        ];
        
        DB::table('option_assistances')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_assistances');
    }
};
