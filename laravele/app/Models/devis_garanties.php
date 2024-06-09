<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devis_garanties extends Model
{
    use HasFactory;
    protected $table = 'devis_garanties';
    protected $fillable = ['garantie_id', 'devis_id', 'option_id'];


    // Si vous ne souhaitez pas de colonnes created_at et updated_at dans cette table
    public $timestamps = false;

    // Relation avec le modèle Devis
    public function devis()
    {
        return $this->belongsTo(Devis::class, 'devis_id');
    }

    // Relation avec le modèle Garantie
    public function garantie()
    {
        return $this->belongsTo(TypeGarantie::class, 'garantie_id');
    }
    public function optionGarantie()
    {
        return $this->belongsTo(OptionGarantie::class, 'option_id');
    }

    
}
