<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Administrateur;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        // Valider les entrées
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $email = $request->input('email');
        $token = $request->input('token');
        $password = $request->input('password');

        // Vérifier si l'utilisateur existe
        $user = Client::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Aucun utilisateur trouvé avec cet email.'], 404);
        }

        // Vérifier si le token de réinitialisation est valide
        $tokenData = DB::table('password_resets')->where('email', $email)->first();

        if (!$tokenData || !hash_equals($tokenData->token, $token)) {
            return response()->json(['message' => 'Token de réinitialisation de mot de passe invalide.'], 400);
        }

        // Mettre à jour le mot de passe de l'utilisateur
        $user->password = Hash::make($password);
        $user->save();

        // Supprimer l'entrée dans la table password_resets
        DB::table('password_resets')->where('email', $email)->delete();

        return response()->json(['message' => 'Mot de passe réinitialisé avec succès.'], 200);
    }
}