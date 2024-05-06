<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeGarantie extends Model
{

    
    use HasFactory;
    protected $fillable = [
        'nomGarantie',
        'description',
        'prixGarantie',
        'dureeGarantie'
    ];

 /* hadi   public function garantiesSelectionnees()
    {
        return $this->hasMany(GarantiesSelectionnees::class, 'garantie_id');
    }
    public function offres()
    {
        return $this->hasMany(GarantiesSelectionnees::class, 'garantie_id');
    }*/
    public function offres()
    {
        return $this->belongsToMany(Offre::class);
    }
   
    
   
}
