<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('id_contrat')->unique()->collation('utf8mb4_unicode_ci');
            $table->foreignId('client_id')->constrained('clients');
           $table->foreignId('id_devis')->constrained('devis');
           $table->foreignId('id_offre')->constrained('offres');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->float('montant_assurance');
            $table->timestamps();
            $table->collation = 'utf8mb4_unicode_ci'; 
        });

        DB::unprepared('
            CREATE TRIGGER generate_id_contrat BEFORE INSERT ON contrats
            FOR EACH ROW
            BEGIN
                DECLARE nouvel_id INT;
                DECLARE current_year CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
                SET current_year = DATE_FORMAT(CURRENT_DATE, "%y");
                SET nouvel_id = (SELECT IFNULL(MAX(CAST(SUBSTRING(id_contrat, 4) AS UNSIGNED)), 0) + 1 
                                 FROM contrats 
                                 WHERE SUBSTRING(id_contrat, 2, 2) = current_year COLLATE utf8mb4_unicode_ci);
                SET NEW.id_contrat = CONCAT("C", current_year, LPAD(nouvel_id, 4, "0")) COLLATE utf8mb4_unicode_ci;
            END
        ');

        // Insert initial data with explicit string handling
        DB::table('contrats')->insert([
            'client_id' => 5,
            'id_devis' => 2,
            'id_offre'=> 2,
            'date_debut' => Carbon::create('2024', '05', '15'),
            'date_fin' => Carbon::create('2025', '05', '15'),
            'montant_assurance' => 500.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('contrats')->insert([
            'client_id' => 3,
            'id_devis' => 1,
            'id_offre'=> 2,
            'date_debut' => Carbon::create('2024', '06', '15'),
            'date_fin' => Carbon::create('2025', '09', '15'),
            'montant_assurance' => 600.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
        DB::unprepared('DROP TRIGGER IF EXISTS generate_id_contrat');
    }
};
