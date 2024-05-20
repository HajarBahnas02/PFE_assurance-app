<?php

namespace App\Models;
use \App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;
    protected $fillable = ['nomVille'];
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}

  

  

