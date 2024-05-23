<?php
//ajouter le role administrateur 
namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client; 

class LoginController extends Controller
{
    public function check(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
    
        if (Auth::guard('client')->attempt($credentials)) {
            // Récupérer l'utilisateur authentifié
            $user = Auth::guard('client')->user();
            
            // Vérifier le rôle de l'utilisateur
            if ($user->role != 0) { // Vérifie si le rôle n'est pas celui d'un client
                Auth::guard('client')->logout(); // Déconnexion de l'utilisateur
                return response()->json(['status' => false, 'error' => 'Accès non autorisé pour les administrateurs'], 401);
            }
            
            // Récupérer le nom du client depuis la table 'clients'
            $clientName = $user->name; // Supposons que le nom du client est stocké dans la colonne 'name'
            // Retourner le nom du client dans la réponse JSON
            return response()->json(['status' => true, 'clientName' => $clientName]);
        } else {
            // Si l'authentification du client échoue
            $errors = [];
            $client = Client::where('email', $credentials['email'])->first();
            if (!$client) {
                $errors['email_not_exist'] = 'email n\'existe pas';
            } else {
                // Si le mot de passe est incorrect
                $errors['wrong_password'] = 'Mot de passe incorrect';
            }
    
            return response()->json(['status' => false, 'errors' => $errors], 400);
        }
    }
        public function adminLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::guard('administrateur')->attempt($credentials)) {
        // Récupérer l'utilisateur authentifié
        $user = Auth::guard('administrateur')->user();

        // Vérifier le rôle de l'utilisateur
        if ($user->role != 1) { // Vérifie si le rôle n'est pas celui d'un administrateur
            Auth::guard('administrateur')->logout(); // Déconnexion de l'utilisateur
            return response()->json(['status' => false, 'error' => 'Accès non autorisé pour les clients'], 401);
        }

        // Récupérer le nom de l'administrateur depuis la table 'administrateurs'
        $adminName = $user->name; // Supposons que le nom de l'administrateur est stocké dans la colonne 'name'
        // Retourner le nom de l'administrateur dans la réponse JSON
        return response()->json(['status' => true, 'adminName' => $adminName]);
    } else {
        // Si l'authentification de l'administrateur échoue
        $errors = [];
        $admin = Administrateur::where('email', $credentials['email'])->first();
        if (!$admin) {
            $errors['email_not_exist'] = 'Email n\'existe pas';
        } else {
            // Si le mot de passe est incorrect
            $errors['wrong_password'] = 'Mot de passe incorrect';
        }

        return response()->json(['status' => false, 'errors' => $errors], 400);
    }
}

}