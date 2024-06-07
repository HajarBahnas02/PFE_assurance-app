<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeGarantie extends Model
{

    
    use HasFactory;
    protected $fillable = [
        'id',
        'nomGarantie',
        'description',
        'prixGarantie',
        'dureeGarantie'
    ];

 
    public function offres()
    {
        return $this->belongsToMany(Offre::class);
        
    }
   
    // Dans le modèle Garantie
public function optionsGaranties()
{
    return $this->hasMany(OptionGarantie::class, 'garantie_id');
}

 
public function options()
{
    return $this->hasMany(OptionGarantie::class, 'garantie_id');
}

public function devis()
{
    return $this->belongsToMany(Devis::class, 'devis_garanties', 'garantie_id', 'devis_id');
}

   
}
