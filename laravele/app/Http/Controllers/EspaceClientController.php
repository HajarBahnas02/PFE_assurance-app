<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class EspaceClientController extends Controller
{
    public function getInfoClient()
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
        
        // Récupérer les informations du client connecté
        $clientInfo = Client::find($user->id);
        
        return response()->json(['status' => true, 'clientInfo' => $clientInfo]);
    }

    public function getClientInfo($id)
    {
        // Récupérer les informations du client par son ID
        $client = Client::find($id);
    
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }
    
        $client->load('ville');
    
        $villeNom = $client->ville->nomVille;
    
        // Ajouter le nom de la ville aux informations du client
        $clientInfo = $client->toArray();
        $clientInfo['ville_nom'] = $villeNom;
    
        return response()->json(['clientInfo' => $clientInfo], 200);
    }

}