<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarantiesSelectionnees extends Model
{
    use HasFactory;
    protected $fillable = [
        'idOffre',
        'idGarantie'
    ];
    public function garantie()
    {
        return $this->belongsTo(TypeGarantie::class, 'garantie_id');
    }
 
   
    
    public function offre()
    {
        return $this->belongsTo(Offre::class, 'offre_id');
    }

  
}

