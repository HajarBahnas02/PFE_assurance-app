<?php

namespace App\Listeners;

use App\Events\DevisCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateDevisNumber
{
    public function handle(DevisCreated $event)
    {
        $devis = $event->devis;
        $devis->numero_devis = 'DV-' . str_pad($devis->id, 8, '0', STR_PAD_LEFT);
        $devis->save();
    }
}