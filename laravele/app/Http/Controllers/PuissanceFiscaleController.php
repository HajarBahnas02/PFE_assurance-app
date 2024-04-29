<?php

namespace App\Http\Controllers;

use App\Models\PuissanceFiscale;
use Illuminate\Http\Request;

class PuissanceFiscaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
        public function index()
        {
            return PuissanceFiscale::all(['id','PuissFiscale']);

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
    public function show(PuissanceFiscale $puissanceFiscale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PuissanceFiscale $puissanceFiscale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PuissanceFiscale $puissanceFiscale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PuissanceFiscale $puissanceFiscale)
    {
        //
    }
}
