<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use App\Models\Devis;
use App\Mail\ContratTraiteMail;

class EmailController extends Controller
{
    public function sendEmailToClient(Request $request)
    {
        $clientId = $request->input('clientId');
        $devisId = $request->input('devisId');

        // Récupérer le client avec l'ID fourni
        $client = Client::find($clientId);

        if (!$client) {
            return response()->json(['message' => 'Client non trouvé.'], 404);
        }

        // Récupérer le devis avec l'ID fourni
        $devis = Devis::find($devisId);

        if (!$devis) {
            return response()->json(['message' => 'Devis non trouvé.'], 404);
        }

        // Utiliser le numéro de devis pour générer l'URL
        $devisNumero = $devis->numero_devis;  // Assurez-vous que `numero` est le nom de la colonne dans votre table `devis`
        $baseUrl = 'http://localhost:5173/tarifications/' . $clientId . '/dev' . $devisNumero;
        // Envoyer l'e-mail avec l'URL générée
        try {
            Mail::to($client->email)->send(new ContratTraiteMail($baseUrl, $client->email));
            return response()->json(['message' => 'Email envoyé avec succès au client.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de l\'envoi de l\'email.', 'error' => $e->getMessage()], 500);
        }
    }
}
