<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Administrateur;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $email = $request->input('email');
        $token = $request->input('token');
        $password = $request->input('password');

        // Vérifier si l'email appartient à un client
        $client = Client::where('email', $email)->first();
        // Vérifier si l'email appartient à un administrateur
        $admin = Administrateur::where('email', $email)->first();

        if ($client) {
            // Réinitialisation du mot de passe pour le client
            $client->password = Hash::make($password);
            $client->save();
        } elseif ($admin) {
            // Réinitialisation du mot de passe pour l'administrateur
            $admin->password = Hash::make($password);
            $admin->save();
        } else {
            return response()->json(['message' => 'Aucun utilisateur trouvé avec cet email.'], 404);
        }

        return response()->json(['message' => 'Mot de passe réinitialisé avec succès.'], 200);
    }
}
