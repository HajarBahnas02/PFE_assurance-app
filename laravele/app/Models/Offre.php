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
        public function garanties(){
            return $this->belongsToMany(TypeGarantie::class)->withTimestamps();
        }
}
