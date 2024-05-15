<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicule_rse;
use App\Http\Requests\VehiculeRse;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  Vehicule::all([
        'matricule',
        'puissanceFiscale',
        'dateMiseEnCirculation',
        'valeurNeuve',
        'valeurVenale',
        'modele_id',
        'type_motorisation_id',
        'marque_id',
        'statut',    ]);
    }


        public function getNonTraitees()
        {
            $vehicules = Vehicule::where('statut', 'non-traitee')
                ->with('montantsProposes')
                ->get();
    
            return response()->json($vehicules);
        }
        public function getVehiculeByMatricule($matricule)
    {
        $vehicule = Vehicule::where('matricule', $matricule)->first();
        return response()->json($vehicule);
    }

   

        public function update($matricule)
       {
            $vehicule = Vehicule::where('matricule', $matricule)->first();
            if ($vehicule) {
                $vehicule->statut = 'traitee';
                $vehicule->save();
                return response()->json(['message' => 'Statut mis à jour avec succès.']);
            }
            return response()->json(['message' => 'Véhicule non trouvé.'], 404);
        }
        
    public function create()
    {
        try {
            $vehicules = Vehicule::where('statut', 'traitee')->get();
            return response()->json($vehicules);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Aucun véhicule avec le statut "traite" trouvé.'], 404);
        }
        }

    
     
    public function store(Vehicule_rse $request)
    {
       Vehicule::create($request->validated());

       return response()->json(["message"=>"Vehicule enregistré avec succès"],201);
    }

    public function show($matricule)
    {
        $vehicule = Vehicule::where('matricule', $matricule)->firstOrFail();
        
        return response()->json($vehicule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicule $vehicule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicule $vehicule)
    {
        //
    }
}
