<?php

namespace App\Http\Controllers;

use App\Models\Montant_Propose;
use Illuminate\Http\Request;

class MontantProposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer tous les montants proposés
        $montantProposes = Montant_Propose::all();
        

        return response()->json($montantProposes);
    }
    public function store(Request $request)
    {
        // Valider les données envoyées par le formulaire
        $request->validate([
            'matricule' => 'required',
            'montant_initial' => 'required|numeric',
            'montant_essentiel' => 'required|numeric',
            'montant_premium' => 'required|numeric',
        ]);

        $montantPropose = new Montant_Propose();
        $montantPropose->matricule = $request->matricule;
        $montantPropose->montant_initial = $request->montant_initial;
        $montantPropose->montant_essentiel = $request->montant_essentiel;
        $montantPropose->montant_premium = $request->montant_premium;
        $montantPropose->save();

        // Retourner une réponse appropriée
        return response()->json(['message' => 'Montant proposé enregistré avec succès'], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

}
