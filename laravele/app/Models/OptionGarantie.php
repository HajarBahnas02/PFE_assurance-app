<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGarantie extends Model
{
    use HasFactory;
    protected $fillable = ['id','valeur', 'nom'];
    public function garantie()
    {
        return $this->belongsTo(TypeGarantie::class, 'garantie_id');
    }

}
