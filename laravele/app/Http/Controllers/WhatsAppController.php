<?php

namespace App\Http\Controllers;
use App\Services\TwilioService;

use Illuminate\Http\Request;

class WhatsAppController extends Controller
{

    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    public function sendMessage()
    {
        $to = '+212650359007'; 
        $message = 'Ceci est un message de test depuis Laravel avec Twilio !'; 
        
        $this->twilioService->sendWhatsAppMessage($to, $message);

        return response()->json(['status' => 'success', 'message' => 'Message envoyé avec succès !']);
    }
}
