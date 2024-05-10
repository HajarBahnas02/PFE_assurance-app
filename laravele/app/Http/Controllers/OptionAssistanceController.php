<?php

namespace App\Http\Controllers;

use App\Models\OptionAssistance;
use Illuminate\Http\Request;

class OptionAssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

        public function index()
        {
            return  OptionAssistance::all(["id",'nomOptionAssistance','description']);
        }
        
        public function getDescription($id)
        {
            // Recherche de l'option d'assistance par son ID
            $optionAssistance = OptionAssistance::findOrFail($id);
        
            // Renvoyer la description de l'option d'assistance
            return response()->json(['description' => $optionAssistance->description]);
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
    public function show(OptionAssistance $optionAssistance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OptionAssistance $optionAssistance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OptionAssistance $optionAssistance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OptionAssistance $optionAssistance)
    {
        //
    }
}
