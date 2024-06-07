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
        // Validation des entrées
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

        if ($client || $admin) {
            // Vérifier si le token correspond à celui stocké en base de données
            $passwordReset = DB::table('password_resets')->where('email', $email)->first();
            if ($passwordReset && hash_equals($passwordReset->token, $token)) {
                // Utiliser une transaction pour assurer la cohérence de la base de données
                DB::beginTransaction();
                try {
                    // Mettre à jour le mot de passe
                    $user = $client ? $client : $admin;
                    $user->password = Hash::make($password);
                    $user->save();

                    // Supprimer le token de réinitialisation de mot de passe
                    DB::table('password_resets')->where('email', $email)->delete();

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['message' => 'Une erreur est survenue lors de la mise à jour du mot de passe.'], 500);
                }

                return response()->json(['message' => 'Mot de passe réinitialisé avec succès.'], 200);
            } else {
                return response()->json(['message' => 'Token de réinitialisation de mot de passe invalide.'], 400);
            }
        }

        return response()->json(['message' => 'Aucun utilisateur trouvé avec cet email.'], 404);
    }


    public function reeset(Request $request)
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

    if ($client || $admin) {
        // Vérifier si le token correspond à celui stocké en base de données
        $passwordReset = DB::table('password_resets')->where('email', $email)->first();
        if ($passwordReset && hash_equals($passwordReset->token, $token)) {
            // Utiliser une transaction pour assurer la cohérence de la base de données
            DB::beginTransaction();
            try {
                // Mettre à jour le mot de passe
                $user = $client ? $client : $admin;
                $user->password = Hash::make($password);
                $user->save();

                // Supprimer le token de réinitialisation de mot de passe
                DB::table('password_resets')->where('email', $email)->delete();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'Une erreur est survenue lors de la mise à jour du mot de passe.'], 500);
            }

            return response()->json(['message' => 'Mot de passe réinitialisé avec succès.'], 200);
        }
    }

    return response()->json(['message' => 'Aucun utilisateur trouvé avec cet email ou ce token.'], 404);
}
}
