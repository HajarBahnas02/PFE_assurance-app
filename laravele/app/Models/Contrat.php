<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'vehicule_matricule',
        'numero_devis',
        'date_debut',
        'date_fin',
        'montant_assurance',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contrat) {
            $contrat->numero_devis = static::generateNumeroDevis();
        });
    }

    private static function generateNumeroDevis()
    {
        return 'DEV-' . Str::upper(Str::random(10));
    }

    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_matricule', 'matricule');
    }
}
