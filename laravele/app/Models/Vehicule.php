<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'puissanceFiscale',
        'dateMiseEnCirculation',
        'valeurNeuve',
        'valeurVenale',
        'modele_id',
        'type_motorisation_id',
        'marque_id',
    ];
}
