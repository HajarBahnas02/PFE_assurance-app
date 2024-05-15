<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarqueController extends Controller
{
    public function index()
    {
        return  Marque::all(["id",'nomMarque']);
       
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
        Marque::create($request->post());

        return response()->json(["message"=>"Vehicule enregistré avec succès"],201);
     }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $nomMarque = Marque::findOrFail($id)->pluck('nomMarque')->first();
            return response()->json(['nomMarque' => $nomMarque], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Marque not found.'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marque $marque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marque $marque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marque $marque)
    {
        //
    }
}
