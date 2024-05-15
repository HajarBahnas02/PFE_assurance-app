<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Montant_Propose;
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
        'statut',
    ];
    protected $primaryKey = 'matricule';

    public $incrementing = false;


  /*  public function montantsProposes()
    {
        return $this->hasMany(Montant_Propose::class);
    }
    public function montantsProposes()
    {
    return $this->hasMany(Montant_Propose::class ,'vehicule_id', 'matricule');
    }*/
    public function montantPropose()
    {
        return $this->hasOne(Montant_Propose::class);
    }
    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }

    public function typeMotorisation()
    {
        return $this->belongsTo(TypeMotorisation::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }
    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'vehicule_matricule', 'matricule');
    }
}
