<?php

namespace App\Models;
use App\Events\DevisCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Vehicule;
class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'matricule',
        'numero_devis',
        'date_debut',
        'montant_initial',
        'montant_premium',
        'montant_essentiel'       
    ];
    protected $dispatchesEvents = [
        'created' => DevisCreated::class,
    ];
 /*   private static function generateNumeroDevis()
    {
        return 'DEV-' . Str::upper(Str::random(10));
    }
*/
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'matricule', 'matricule');
    }
 
}
