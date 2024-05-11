<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Administrateur extends  Authenticatable

{
    use HasFactory;
    protected $fillable = ['id','nom','prenom','cin','password','email'];


}
