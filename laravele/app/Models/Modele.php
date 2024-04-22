<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;
    protected $table = 'modeles';
    protected $fillable = ['nom'];
  

 public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }
}

