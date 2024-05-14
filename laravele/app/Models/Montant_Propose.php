<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Montant_Propose extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicule_id',
        'montant_initial',
        'montant_essentiel',
        'montant_premium',
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}