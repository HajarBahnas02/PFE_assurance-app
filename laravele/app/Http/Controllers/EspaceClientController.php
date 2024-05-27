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
}