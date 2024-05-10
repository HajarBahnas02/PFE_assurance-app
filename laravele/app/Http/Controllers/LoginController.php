<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client; // Importez le modèle Client

class LoginController extends Controller
{
  
public function check(Request $request)
{
    $credentials = $request->validate([
        'cin' => ['required' ],
        'password' => ['required'],
    ]);

    if (Auth::guard('client')->attempt($credentials)) {
                 // Récupérer le nom du client depuis la tzble 'clients'
                 $user = Auth::guard('client')->user();
                 $clientName = $user->name; // Supposons que le nom du client est stocké dans la colonne 'name'
                 // Retourner le nom du client dans la réponse JSON
                 return response()->json(['status' => true, 'clientName' => $clientName]);
    }
else{
    $errors = [];
    $client = Client::where('cin', $credentials['cin'])->first();
    if (!$client) {
        $errors['cin_not_exist'] = 'CIN n\'existe pas';
    } else {
        // Si le mot de passe est incorrect
        $errors['wrong_password'] = 'Mot de passe incorrect';
    }

    return response()->json(['status' => false, 'errors' => $errors], 400);

}
    
}
  
}
