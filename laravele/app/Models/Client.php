<?php

namespace App\Models;
use GuzzleHttp;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use \App\Models\Ville;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Client extends Authenticatable implements CanResetPassword
{
        use HasFactory;

    use HasApiTokens, Notifiable;

    protected $fillable = ['id', 'nom', 'prenom', 'cin','date_naissance' ,'password', 'email','ville_id','telephone','role'];

    protected $hidden = [
        'password', 'remember_token',
    ];
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
    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
