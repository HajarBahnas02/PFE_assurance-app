<?php

namespace App\Http\Controllers;
use App\Models\Ville;
use App\Models\Client;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      Store a newly created resource in storage.
    
    public function store(Request $request,$id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'telephone' => 'required|string|max:20|unique:clients',
            'ville_id' => 'required|exists:villes,id',
            'cin' => 'required|string|unique:clients,cin',
            'password' => 'required|string|min:8',
        ]);

        $client = Client::findOrFail($id);
        $client->cin = $request->input('cin');
        $client->password = bcrypt($request->input('password')); // Encrypt the password
        $client->save();
        return response()->json(["message" => "Client ajouté avec succès!"], 201);
    } */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:35',
            'prenom' => 'required|string|max:35',
            'email' => 'required|string|email|max:255|unique:clients',
            'telephone' => 'required|string|max:20|unique:clients',
            'ville_id' => 'required|exists:villes,id',
            'date_naissance'=>'required',
        ]);
    
        $client = Client::create($validatedData);
    
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
 
  /*  public function update(Request $request)
    {
        // Récupère l'utilisateur actuellement authentifié
        $client = Auth::user();

        // Met à jour les informations du client avec les données fournies dans la requête,
        // sauf le mot de passe
        $client->update($request->except('password'));

        // Vérifie si la requête contient un champ 'password'
        if ($request->has('password')) {
            // Si un mot de passe est fourni, il est haché avant d'être enregistré
            $client->password = bcrypt($request->password);
            // Sauvegarde l'instance du client avec le mot de passe mis à jour
            $client->save();
        }

        // Retourne la réponse en JSON avec les informations mises à jour du client
        return response()->json($client);
    }*/

    /*
      Update the specified resource in storage.
    
    public function update(Request $request, Client $client)
    {
        
    }
 */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
