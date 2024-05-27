<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté
        $user->currentAccessToken()->delete(); // Révoquer le token actuel de l'utilisateur
        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }
}
