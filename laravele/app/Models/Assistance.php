<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OptionAssistance;

class Assistance extends Model
{
    use HasFactory;
    protected $fillable = ['id','nomAssistance'];
    public function optionsAssistances()
    {
        return $this->hasMany(OptionAssistance::class);
    }
}
