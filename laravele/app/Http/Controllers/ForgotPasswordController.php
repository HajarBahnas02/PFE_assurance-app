<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendClientResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $response = Password::broker('clients')->sendResetLink(
            $request->only('email')
        );
        return response()->json(['message' => trans($response)]);
    }

    public function sendAdminResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $response = Password::broker('administrateurs')->sendResetLink(
            $request->only('email')
        );
        return response()->json(['message' => trans($response)]);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
    
}
