<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
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

        $client = Client::where('email', $email)->first();
        $admin = Administrateur::where('email', $email)->first();

        if ($client) {
            $status = Password::broker('clients')->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = bcrypt($password);
                    $user->save();
                }
            );
        } elseif ($admin) {
            $status = Password::broker('administrateurs')->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = bcrypt($password);
                    $user->save();
                }
            );
        } else {
            return response()->json(['message' => 'Aucun utilisateur trouvé avec cet email.'], 404);
        }

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Mot de passe réinitialisé avec succès.'], 200)
            : response()->json(['message' => 'Erreur lors de la réinitialisation du mot de passe.'], 400);
    }
}
