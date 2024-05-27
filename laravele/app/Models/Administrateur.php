<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrateur  extends Authenticatable implements CanResetPassword

{
    use HasFactory;    use HasApiTokens, Notifiable;

    protected $fillable = ['id','nom','prenom','cin','password','email'];


}
