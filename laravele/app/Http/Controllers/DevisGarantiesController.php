<?php

namespace App\Http\Controllers;
use App\Models\Devis;
use App\Models\devis_garanties;
use Illuminate\Http\Request;

class DevisGarantiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        {
            // Récupérer l'ID du devis et les garanties sélectionnées depuis la requête
            $devisId = $request->input('devis_id');
            $selectedGaranties = $request->input('selectedGaranties');
        
            // Parcourir les garanties sélectionnées et les enregistrer dans la table devis_garanties
            foreach ($selectedGaranties as $garantieId) {
                devis_garanties::create([
                    'devis_id' => $devisId,
                    'garantie_id' => $garantieId,
                ]);
            }
        
            // Retourner une réponse appropriée
            return response()->json(['message' => 'Garanties enregistrées avec succès.']);
        } }
   
    public function show(devis_garanties $devis_garanties)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(devis_garanties $devis_garanties)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, devis_garanties $devis_garanties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(devis_garanties $devis_garanties)
    {
        //
    }
}
