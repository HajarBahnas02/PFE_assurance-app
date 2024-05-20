<?php

namespace App\Http\Controllers;

use App\Models\Modele;
use Illuminate\Http\Request;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modeles = Modele::all();
        return response()->json($modeles);
    }
    public function getModelName($id)
    {
        $model = Modele::findOrFail($id);
        return response()->json($model->nomModele);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   
    public function store()
    {
        $modeles = [
            ['name' => 'Peugeot'],
            ['name' => 'Renault'],
            ['name' => 'Citroën'],
            ['name' => 'Volkswagen'],
            ['name' => 'Mercedes'],
            ['name' => 'Toyota'],
            ['name' => 'Audi'],
            ['name' => 'BMW'],
        ];

        Modele::insert($modeles);

        return response()->json(['message' => 'Données insérées avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Modele $modele)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modele $modele)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modele $modele)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modele $modele)
    {
        //
    }
}
