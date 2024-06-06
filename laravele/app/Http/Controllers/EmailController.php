<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use App\Mail\ContratTraiteMail;
class EmailController extends Controller
{
    public function sendEmailToClienst($clientId)
    {
        // Récupérer le client avec l'ID fourni
        $client = Client::find($clientId);
    
        if (!$client) {
            return response()->json(['message' => 'Client non trouvé.'], 404);
        }
    
        // Générer l'URL avec l'ID du client inclus
        $baseUrl = 'http://localhost:5173/tarifications/' . $clientId;
    
        // Envoyer l'e-mail avec l'URL générée
        Mail::send(new ContratTraiteMail($baseUrl, $client->email));
    
        return response()->json(['message' => 'Email envoyé avec succès au client.']);
    }
    public function sendEmailToClient(Request $request)
    {
        $clientId = $request->input('clientId');
        $devisId = $request->input('devisId');

        // Récupérer le client avec l'ID fourni
        $client = Client::find($clientId);

        if (!$client) {
            return response()->json(['message' => 'Client non trouvé.'], 404);
        }
        $baseUrl = 'http://localhost:5173/tarifications/' . $clientId . '/dev' . $devisId;

        // Envoyer l'e-mail avec l'URL générée
        Mail::to($client->email)->send(new ContratTraiteMail($baseUrl, $client->email));

        return response()->json(['message' => 'Email envoyé avec succès au client.']);
    }
    

}

   

