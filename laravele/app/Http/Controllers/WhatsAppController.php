<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client as TwilioClient;
use App\Models\Client as AppClient;
use App\Models\Devis;

class WhatsAppController extends Controller
{
    public function sendMessage(Request $request)
    {
        $clientId = $request->input('clientId');
        $devisId = $request->input('devisId');

        // Récupérer le client avec l'ID fourni
        $appClient = AppClient::find($clientId);


        if (!$appClient) {
            return response()->json(['message' => 'Client non trouvé.'], 404);
        }

        // Récupérer le devis avec l'ID fourni
        $devis = Devis::find($devisId);

        if (!$devis) {
            return response()->json(['message' => 'Devis non trouvé.'], 404);
        }

        // Construire le texte du message avec le lien
        $devisNumero = $devis->numero_devis;
        $baseUrl = 'http://localhost:5173/tarifications/' . $clientId . '/dev' . $devisNumero;
        $message = "Bonjour! Votre devis est prêt. Vous pouvez le consulter en suivant ce lien : $baseUrl";

        // Informations d'authentification Twilio
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_WHATSAPP_NUMBER');

        try {
            // Initialiser le client Twilio
            $twilioClient = new TwilioClient($accountSid, $authToken);

            // Envoyer le message WhatsApp
            $twilioClient->messages->create(
                "whatsapp:212650359007", // Numéro de téléphone du destinataire
                [
                    "from" => "whatsapp:$twilioNumber", // Numéro de téléphone Twilio
                    "body" => $message, // Corps du message
                ]
            );

            // Réponse JSON
            return response()->json(['message' => 'Message WhatsApp envoyé avec succès.']);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur
            return response()->json(['error' => 'Une erreur s\'est produite lors de l\'envoi du message WhatsApp.', 'error_detail' => $e->getMessage()], 500);
        }
    }
}
