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


        DB::unprepared('
            CREATE TRIGGER generate_numero_devis BEFORE INSERT ON devis
            FOR EACH ROW
            BEGIN
                DECLARE nouvel_id INT;
                DECLARE current_year CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
                SET current_year = DATE_FORMAT(CURRENT_DATE, "%y");
                SET nouvel_id = (SELECT IFNULL(MAX(CAST(SUBSTRING(numero_devis, 4, 6) AS UNSIGNED)), 0) + 1 
                                 FROM devis 
                                 WHERE SUBSTRING(numero_devis, 1, 1) = "D" AND SUBSTRING(numero_devis, 2, 2) = current_year COLLATE utf8mb4_unicode_ci);
                SET NEW.numero_devis = CONCAT("D", current_year, LPAD(nouvel_id, 6, "0")) COLLATE utf8mb4_unicode_ci;
            END
        ');
        DB::table('devis')->insert([
            'id'=>1,
            'client_id' => 5,
            'matricule' => 'FGH123',
            'numero_devis' => 'DEV-' . Str::upper(Str::random(10)),
            'date_debut' => '2024-05-15',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('devis')->insert([
            'id'=>2,
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
