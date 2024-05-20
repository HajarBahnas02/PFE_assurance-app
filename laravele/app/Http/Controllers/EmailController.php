<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use App\Mail\ContratTraiteMail;
class EmailController extends Controller
{
public function sendEmailToClient($clientId)
{
    // Récupérer le client avec l'ID fourni
    $client = Client::find($clientId);

    if (!$client) {
        return response()->json(['message' => 'Client non trouvé.'], 404);
    }

    // Générer l'URL de base: 
    //$id_devis =
    $baseUrl = 'http://localhost:5173/tarification';
    Mail::send(new ContratTraiteMail($baseUrl, $client->email));
    return response()->json(['message' => 'Email envoyé avec succès au client.']);
}

}

   

