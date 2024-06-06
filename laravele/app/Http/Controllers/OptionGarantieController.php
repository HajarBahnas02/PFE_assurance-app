<?php

namespace App\Http\Controllers;

use App\Models\OptionGarantie;
use Illuminate\Http\Request;

class OptionGarantieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  OptionGarantie::all(["id",'nom','valeur']);

    }
    public function afficherOptionGarantieAvecNomGarantie($id)
    {
        // Récupérer l'option de garantie avec le nom de la garantie associée
        $optionGarantie = OptionGarantie::with('garantie')->findOrFail($id);

        // Retourner les données au format JSON
        return response()->json($optionGarantie, 200);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OptionGarantie $optionGarantie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OptionGarantie $optionGarantie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OptionGarantie $optionGarantie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OptionGarantie $optionGarantie)
    {
        //
    }
}
