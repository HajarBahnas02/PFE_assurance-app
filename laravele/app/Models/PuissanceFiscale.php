<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuissanceFiscale extends Model
{
    use HasFactory;
    protected $table = 'puissance_fiscale';

    protected $fillable = [
        'PuissFiscale',
    ];
}
