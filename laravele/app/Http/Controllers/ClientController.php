<?php

namespace App\Http\Controllers;
use App\Models\Ville;
use App\Models\Client;
use App\Models\Devis;
use App\Models\Contrat;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Symfony\Contracts\Service\Attribute\Required;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  Client::all(["id",'nom','prenom','cin','email']);

    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function sendWhatsAppMessage(Request $request, Client $client)
    {
        $message = $request->input('message', 'Message de test depuis Laravel.');
        $phone = $client->telephone;

        $this->twilioService->sendWhatsAppMessage($phone, $message);

        return response()->json(['status' => 'success', 'message' => 'Message WhatsApp envoyé avec succès au client.']);
    }
    /*
   } */
   public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:35',
            'prenom' => 'required|string|max:35',
            'email' => 'required|string|email|max:255',
            'telephone' => 'required|string|max:20',
            'ville_id' => 'required|exists:villes,id',
            'date_naissance' => 'required|date',
            'password' => 'required|string|min:8|same:confirmPassword',
        ]);

         $hashedPassword = Hash::make($validatedData['password']);

        // Créer un nouveau client avec le mot de passe haché
        $client = Client::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'telephone' => $validatedData['telephone'],
            'ville_id' => $validatedData['ville_id'],
            'date_naissance' => $validatedData['date_naissance'],
            'password' => $hashedPassword, // Stocker le mot de passe haché
        ]);

        return response()->json(['message' => 'Client ajouté avec succès!', 'client' => $client], 201);
    }
    public function getVilles()
    {
        return Ville::all();
    }
    /*
     * Display the specified resource.
    
    public function show($id)
    {
        $client = Client::with('ville')->findOrFail($id);
        return response()->json($client);
    } */
    public function show($id)
    {
        $client = Client::join('villes', 'clients.ville_id', '=', 'villes.id')
            ->select('clients.*', 'villes.nomVille as ville_nom')
            ->where('clients.id', $id)
            ->first();

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }
    public function getDevis($clientId)
    {
        // Récupérer tous les devis associés au client spécifié
        $devis = Devis::where('client_id', $clientId)->get();
        
        // Retourner les devis au format JSON
        return response()->json(['devis' => $devis]);
    }
    public function setPassword(Request $request, $id)
    {
        // Valider la requête
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Trouver le client associé
        $client = Client::findOrFail($id);
    
        // Mettre à jour le mot de passe du client
        $client->password = Hash::make($request->password);
        $client->save();
    
        // Répondre avec une confirmation
        return response()->json(['message' => 'Mot de passe enregistré avec succès'], 200);
    }
    public function getContrats($clientId)
    {
        // Récupérer tous les contrats associés au client spécifié
        $contrats = Contrat::where('client_id', $clientId)->get();
    
        foreach ($contrats as $contrat) {
            // Récupérer le devis associé au contrat
            $devis = Devis::with('vehicule')->find($contrat->id_devis);
    
            // Assurez-vous que le devis existe
            if ($devis) {
                // Ajoutez les informations du devis et du véhicule au contrat
                $contrat->devis = $devis;
                $contrat->matricule = $devis->matricule;
    
                // Si vous avez besoin d'accéder aux informations du véhicule, vous pouvez le faire comme suit
                if ($devis->vehicule) {
                    $contrat->vehicule = $devis->vehicule;
                }
            }
        }
        return response()->json(['contrats' => $contrats]);
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
