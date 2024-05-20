<?php

namespace App\Http\Controllers;
use App\Models\Vehicule;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Mail\ContratTraiteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contrats = Contrat::with('client')->get();

        $contratData = $contrats->map(function($contrat) {
            return [
                'numero_devis' => $contrat->numero_devis,
                'nom' => $contrat->client->nom,
                'prenom' => $contrat->client->prenom,
                'telephone' => $contrat->client->telephone,
                'email'=>$contrat->client->email,
                'vehicule_matricule' => $contrat->vehicule_matricule,
                'date_debut' => $contrat->date_debut,
            ];
        });

        return response()->json($contratData);
    }
    public function devisNonTraites()
    {
        $devis = Contrat::with('client')
            ->where('statut', 'non-traitee')
            ->get(['id', 'vehicule_matricule', 'client_id', 'numero_devis']);

        return response()->json($devis);
    }

    public function getContratsNonTraites()
    {
        $contrats = Contrat::with(['client:id,nom,prenom,telephone,email', 'vehicule:matricule'])
            ->whereHas('vehicule', function($query) {
                $query->where('statut', 'non-traitee');
            })
            ->get(['id', 'client_id', 'vehicule_matricule', 'numero_devis', 'date_debut']);

        $data = $contrats->map(function ($contrat) {
            return [
                'id_devis' => $contrat->numero_devis,
                'client_nom' => $contrat->client->nom,
                'client_prenom' => $contrat->client->prenom,
                'client_telephone' => $contrat->client->telephone,
                'client_email'=>$contrat->client->email,
                'vehicule_matricule' => $contrat->vehicule_matricule,
                'date_debut' => $contrat->date_debut,
            ];
        });

        return response()->json($data);
    }   
     public function getContratsTraites()
    {
        $contrats = Contrat::with(['client:id,nom,prenom,telephone,email','vehicule:matricule'])
            ->whereHas('vehicule', function($query) {
                $query->where('statut', 'traitee');
            })
            ->get(['id', 'client_id', 'vehicule_matricule', 'numero_devis', 'date_debut']);

        $data = $contrats->map(function ($contrat) {
            return [
                'id_devis' => $contrat->numero_devis,
                'client_nom' => $contrat->client->nom,
                'client_prenom' => $contrat->client->prenom,
                'client_telephone' => $contrat->client->telephone,
                'client_email'=>$contrat->client->email,
                'vehicule_matricule' => $contrat->vehicule_matricule,
                'date_debut' => $contrat->date_debut,
            ];
        });

        return response()->json($data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrat $contrat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrat $contrat)
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
            Mail::to($vehicule->client->email)->send(new ContratTraiteMail($vehicule->client));
            return response()->json(['message' => 'Statut mis à jour avec succès et email envoyé au client.']);
        }
        return response()->json(['message' => 'Véhicule non trouvé.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrat $contrat)
    {
        //
    }
}
