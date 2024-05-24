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
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            // Récupération du token de réinitialisation
            $token = DB::table('password_resets')->where('email', $request->email)->first()->token;
            // Envoi de l'email personnalisé
            Mail::to($request->email)->send(new ResetPasswordEmail($token, $request->email));
            
            return response()->json(['message' => 'Un email de réinitialisation de mot de passe a été envoyé à votre adresse email.'], 200);
        } else {
            return response()->json(['message' => ' l\'email fourni n\'existe pas.'], 400);
        }
    }
}