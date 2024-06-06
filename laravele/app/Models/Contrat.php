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
        'id_offre',
        'date_debut',
        'date_fin',
        'montant_assurance',
    ];
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_matricule', 'matricule');
    }
    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }

}
