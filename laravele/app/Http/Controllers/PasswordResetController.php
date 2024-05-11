<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        
    }


}
