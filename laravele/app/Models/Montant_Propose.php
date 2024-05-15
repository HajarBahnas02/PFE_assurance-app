<?php

namespace App\Models;
use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Montant_Propose extends Model
{
    use HasFactory;
    protected $table = 'montantsproposes'; // Nom de votre table dans la base de données
    protected $fillable = [
        'matricule',
        'montant_initial',
        'montant_essentiel',
        'montant_premium',
    ];
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_id', 'matricule');
    }
   
}