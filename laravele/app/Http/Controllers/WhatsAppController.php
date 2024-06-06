<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function sendMessag(Request $request)
    {
        Log::info('Received request to send WhatsApp message', $request->all());

        // Validation des données
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        // Normalisation du numéro de téléphone
        $userPhone = $this->normalizePhoneNumber($request->input('phone'));
        $message = $request->input('message');

        // Log des données validées
        Log::info('Validated input', ['phone' => $userPhone, 'message' => $message]);

        // Récupération des identifiants Twilio
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $companyPhone = env('TWILIO_WHATSAPP_COMPANY_PHONE'); // Numéro de téléphone de l'entreprise

        Log::info('Twilio credentials', ['sid' => $sid, 'from' => $companyPhone]);

        // Instanciation du client Twilio
        $client = new Client($sid, $token);

        try {
            // Envoi du message via Twilio
            $client->messages->create(
                'whatsapp:' . $companyPhone, // Destinataire (numéro de l'entreprise)
                [
                    'from' => 'whatsapp:' . $userPhone, // Expéditeur (numéro de téléphone du client)
                    'body' => $message // Contenu du message
                ]
            );

            // Enregistrement du message dans la base de données
            Message::create([
                'phone' => $userPhone,
                'message' => $message
            ]);

            // Réponse succès
            return response()->json(['status' => 'Message sent successfully']);
        } catch (\Exception $e) {

            Log::error('Failed to send WhatsApp message', ['error' => $e->getMessage()]);

            return response()->json(['status' => 'Failed to send message', 'error' => $e->getMessage()], 500);
        }
    }

    private function normalizePhoneNumber($phone)
    {
        // Retirer les espaces, tirets, parenthèses et autres caractères non numériques
        $phone = preg_replace('/\D+/', '', $phone);

        // Ajouter le signe plus si absent
        if (substr($phone, 0, 1) !== '+') {
            $phone = '+' . $phone;
        }

        return $phone;
    }
}
