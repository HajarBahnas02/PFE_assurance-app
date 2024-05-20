<?php

namespace App\Models;
use GuzzleHttp;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \App\Models\Ville;
class Client extends Authenticatable implements CanResetPassword
{
    use Notifiable;

    protected $fillable = ['id', 'nom', 'prenom', 'cin','date_naissance' ,'password', 'email','ville_id','telephone','role'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }
    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

}
