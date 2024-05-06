<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\TypeGarantie;
class Offre extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomOffre',
        'description'];
   
       /* public function garanties()
        {
            return $this->hasMany(TypeGarantie::class, 'offre_id');
        } }*/
        public function garantiesSelectionnees()
        {
            return $this->hasMany(GarantiesSelectionnees::class, 'offre_id');
        }
        public function garanties(){
            return $this->belongsToMany(TypeGarantie::class)->withTimestamps();
        }
}
