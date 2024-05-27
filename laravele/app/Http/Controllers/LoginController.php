<?php
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
                 /** @var \App\Models\Client $user **/
                 $user = Auth::guard('client')->user();

            if ($user->role != 0) {
                Auth::guard('client')->logout();
                return response()->json(['status' => false, 'error' => 'Accès non autorisé pour les administrateurs'], 401);
            }

            $clientName = $user->nom . ' ' . $user->prenom;
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['status' => true, 'clientName' => $clientName, 'token' => $token]);
        } else {
            $errors = [];
            $client = Client::where('email', $credentials['email'])->first();
            if (!$client) {
                $errors['email_not_exist'] = 'Email n\'existe pas';
            } else {
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
    /** @var \App\Models\Client $user **/
    $user = Auth::guard('administrateur')->user();
            if ($user->role != 1) {
                Auth::guard('administrateur')->logout();
                return response()->json(['status' => false, 'error' => 'Accès non autorisé pour les clients'], 401);
            }

            $adminName = $user->name; // Assurez-vous que cette colonne existe dans votre table administrateurs
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['status' => true, 'adminName' => $adminName, 'token' => $token]);
        } else {
            $errors = [];
            $admin = Administrateur::where('email', $credentials['email'])->first();
            if (!$admin) {
                $errors['email_not_exist'] = 'Email n\'existe pas';
            } else {
                $errors['wrong_password'] = 'Mot de passe incorrect';
            }

            return response()->json(['status' => false, 'errors' => $errors], 400);
        }
    }
}
