<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
class Administrateur  extends Authenticatable implements CanResetPassword

{
    use HasFactory;
    protected $fillable = ['id','nom','prenom','cin','password','email'];


}
