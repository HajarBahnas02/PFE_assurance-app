<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Devis;
use App\Models\Offre;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function getMontants($idDevis)
    {
        $devis = Devis::find($idDevis);
    
        if ($devis) {
            return response()->json([
                'montant_initial' => $devis->montant_initial,
                'montant_essentiel' => $devis->montant_essentiel,
                'montant_premium' => $devis->montant_premium
            ]);
        } else {
            return response()->json(['error' => 'Devis not found'], 404);
        }
    }
    public function fetchMontantsForOffres()
{
    $offres = Offre::with('devis')->get(); 
    
    return response()->json($offres);
}

    public function getDevisNonTraites()
    {
        $devis = Devis::with(['client:id,nom,prenom,telephone,email', 'vehicule:matricule'])
            ->whereHas('vehicule', function($query) {
                $query->where('statut', 'non-traitee');
            })
            ->get(['id', 'client_id', 'matricule', 'numero_devis', 'date_debut']);

        $data = $devis->map(function ($devis) {
            return [
                'id_devis' => $devis->numero_devis,
                'id_client'=>$devis->client->id,
                'client_nom' => $devis->client->nom,
                'client_prenom' => $devis->client->prenom,
                'client_telephone' => $devis->client->telephone,
                'client_email'=>$devis->client->email,
                'matricule' => $devis->matricule,
                'date_debut' => $devis->date_debut,
            ];
        });

        return response()->json($data);
    }   
    public function getDevisTraites()
    {
        $devis = Devis::with(['client:id,nom,prenom,telephone,email','vehicule:matricule'])
            ->whereHas('vehicule', function($query) {
                $query->where('statut', 'traitee');
            })
            ->get(['id', 'client_id', 'matricule', 'numero_devis', 'date_debut']);

        $data = $devis->map(function ($devis) {
            return [
                'id_devis' => $devis->numero_devis,
                'client_nom' => $devis->client->nom,
                'client_prenom' => $devis->client->prenom,
                'client_telephone' => $devis->client->telephone,
                'client_email'=>$devis->client->email,
                'matricule' => $devis->matricule,
                'date_debut' => $devis->date_debut,
            ];
        });

        return response()->json($data);
    }
   /* public function ajouter(Request $request, $id)
{
    $request->validate([
        'montant_initial' => 'required|numeric',
        'montant_essentiel' => 'required|numeric',
        'montant_propose' => 'required|numeric',
    ]);

    $devis = Devis::findOrFail($id);
    $devis->update([
        'montant_initial' => $request->input('montant_initial'),
        'montant_essentiel' => $request->input('montant_essentiel'),
        'montant_propose' => $request->input('montant_propose'),
    ]);

    return response()->json(['message' => 'Devis mis à jour avec succès!']);
}*/
public function reccuperId(Request $request, $clientId)
{
    // Récupérer le client à partir de l'ID
    $client = Client::find($clientId);

    if (!$client) {
        return response()->json(['message' => 'Client non trouvé.'], 404);
    }
    return response()->json(['clientId' => $clientId]);
}
public function getMontantsProposes($clientId)
{
    // Récupérer les montants proposés à partir de la table devis pour un client donné
    $devis = Devis::where('client_id', $clientId)->first();

    if (!$devis) {
        return response()->json(['message' => 'Devis non trouvé pour ce client.'], 404);
    }

    // Extraire les montants proposés
    $montantInitial = $devis->montant_initial;
    $montantEssentiel = $devis->montant_essentiel;
    $montantPremium = $devis->montant_premium;

    return response()->json([
        'montant_initial' => $montantInitial,
        'montant_essentiel' => $montantEssentiel,
        'montant_premium' => $montantPremium
    ]);
}
public function ajouter(Request $request, $numero_devis)
{
    $request->validate([
        'montant_initial' => 'required|numeric',
        'montant_essentiel' => 'required|numeric',
        'montant_premium' => 'required|numeric',
    ]);

    // Recherche du devis par son numéro
    $devis = Devis::where('numero_devis', $numero_devis)->first();

    // Vérifie si le devis existe
    if (!$devis) {
        return response()->json(['message' => 'Devis non trouvé.'], 404);
    }

    // Mise à jour des montants du devis
    $devis->update([
        'montant_initial' => $request->input('montant_initial'),
        'montant_essentiel' => $request->input('montant_essentiel'),
        'montant_premium' => $request->input('montant_premium'),
    ]);

    return response()->json(['message' => 'Montants du devis mis à jour avec succès!']);
}

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données de la requête
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'matricule' => 'required|exists:vehicules,matricule',
            'date_debut' => 'required|date',
        ]);

        // Générer le numéro de devis
        $numeroDevis = 'DEV-' . time(); // Vous pouvez utiliser un format différent si nécessaire

        // Créer un nouvel objet devis avec les données validées et le numéro de devis généré
        $devis = new Devis();
        $devis->client_id = $validatedData['client_id'];
        $devis->matricule = $validatedData['matricule'];
        $devis->date_debut = $validatedData['date_debut'];
        $devis->numero_devis = $numeroDevis;

        // Enregistrer le devis dans la base de données
        $devis->save();

        // Répondre avec un message de succès
        return response()->json(['message' => 'Devis créé avec succès', 'numero_devis' => $numeroDevis]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Devis $devis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Devis $devis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($matricule)
    {
        $vehicule = Vehicule::where('matricule', $matricule)->first();
        if ($vehicule) {
            $vehicule->statut = 'traitee';
            $vehicule->save();
//            Mail::to($vehicule->client->email)->send(new ContratTraiteMail($vehicule->client));
            return response()->json(['message' => 'Statut mis à jour avec succès et email envoyé au client.']);
        }
        return response()->json(['message' => 'Véhicule non trouvé.'], 404);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devis $devis)
    {
        //
    }
}
