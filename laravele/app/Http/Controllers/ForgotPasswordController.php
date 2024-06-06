<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        // Validation de l'email dans la requête
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            $passwordReset = DB::table('password_resets')->where('email', $request->email)->first();

            // Vérification si l'enregistrement existe et contient un token
            if ($passwordReset && isset($passwordReset->token)) {
                Mail::to($request->email)->send(new ResetPasswordEmail($passwordReset->token, $request->email));
                return response()->json(['message' => 'Un email de réinitialisation de mot de passe a été envoyé à votre adresse email.'], 200);
            } else {
                // Retourne une réponse d'erreur si le token n'est pas récupéré
                return response()->json(['message' => 'Erreur lors de la récupération du token de réinitialisation.'], 500);
            }
        } else {
            // Retourne une réponse d'erreur si l'email n'existe pas dans la base de données
            return response()->json(['message' => 'L\'email fourni n\'existe pas.'], 400);
        }
    }
}