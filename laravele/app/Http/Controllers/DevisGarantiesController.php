<?php

namespace App\Http\Controllers;
use App\Models\Devis;
use App\Models\devis_garanties;
use App\Models\devis_option_garanties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        try {
            // Récupérer l'ID du devis, les garanties sélectionnées et les options associées depuis la requête
            $devisId = $request->input('devis_id');
            $selectedGaranties = $request->input('selectedGaranties');
            $selectedOptions = $request->input('selectedOptions');
    
            // Parcourir les garanties sélectionnées
            foreach ($selectedGaranties as $garantieId) {
                // Créer la garantie dans la table devis_garanties
                $devisGarantie = devis_garanties::create([
                    'devis_id' => $devisId,
                    'garantie_id' => $garantieId,
                ]);
    
                // Vérifier si une option est associée à cette garantie
                if (isset($selectedOptions[$garantieId])) {
                    // Enregistrer l'option associée à la garantie dans la même ligne de la table devis_garanties
                    $devisGarantie->option_id = $selectedOptions[$garantieId];
                    $devisGarantie->save();
                }
            }
    
            // Retourner une réponse appropriée
            return response()->json(['message' => 'Garanties et options enregistrées avec succès.']);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur
            return response()->json(['error' => 'Erreur lors de l\'enregistrement des garanties et options.'], 500);
        }
    }
    

    public function show($devisId)
    {
        $garanties = DB::table('devis_garanties')
            ->join('type_garanties', 'devis_garanties.garantie_id', '=', 'type_garanties.id')
            ->leftJoin('option_garanties', 'devis_garanties.option_id', '=', 'option_garanties.id')
            ->where('devis_garanties.devis_id', $devisId)
            ->select('type_garanties.nomTypeGarantie', 'option_garanties.nom as optionNom')
            ->get();

        return response()->json($garanties);
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
