<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Devis;
use Illuminate\Http\Request;

class TarificationController extends Controller
{
    public function show($clientId, $devisId)
    {
        $client = Client::findOrFail($clientId);
        $devis = Devis::with('offres')->findOrFail($devisId);

        if ($devis->client_id !== $client->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('tarification', ['devis' => $devis, 'client' => $client]);
    }
}
