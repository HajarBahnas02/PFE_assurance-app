<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Montant_Propose;

class MontantProposeController extends Controller
{
   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicule_id' => 'required|exists:vehicules,matricule',
            'montant' => 'required|numeric|min:0',
        ]);
        $montantPropose = Montant_Propose::create($validatedData);

        // Retourner une réponse
        return response()->json(['message' => 'Montant proposé enregistré avec succès', 'montant_propose' => $montantPropose], 201);
    }

    // Méthode pour afficher un montant proposé spécifique
    public function show($id)
    {
        $montantPropose = Montant_Propose::findOrFail($id);

        return response()->json(['montant_propose' => $montantPropose], 200);
    }

    // Méthode pour mettre à jour un montant proposé
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vehicule_id' => 'exists:vehicules,matricule',
            'montant' => 'numeric|min:0',
        ]);

        // Trouver le montant proposé à mettre à jour
        $montantPropose = Montant_Propose::findOrFail($id);

        // Mettre à jour les données du montant proposé
        $montantPropose->update($validatedData);

        // Retourner une réponse
        return response()->json(['message' => 'Montant proposé mis à jour avec succès', 'montant_propose' => $montantPropose], 200);
    }

    
    public function destroy($id)
    {
        $montantPropose = Montant_Propose::findOrFail($id);

        $montantPropose->delete();

        return response()->json(['message' => 'Montant proposé supprimé avec succès'], 200);
    }
}
