<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable implements CanResetPassword
{
    use Notifiable;

    protected $fillable = ['id', 'nom', 'prenom', 'cin', 'password', 'email'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }
    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

}
