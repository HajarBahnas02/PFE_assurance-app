<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Un email de réinitialisation de mot de passe a été envoyé à votre adresse email.'], 200);
        } else {
            return response()->json(['message' => 'Une erreur s\'est produite lors de l\'envoi de l\'email de réinitialisation.'], 400);
        }
    }
}