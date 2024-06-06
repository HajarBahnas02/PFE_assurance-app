<?php

namespace App\Http\Controllers;

use App\Models\TypeGarantie;
use Illuminate\Http\Request;
use App\Models\OptionGarantie;

class TypeGarantieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garanties = TypeGarantie::with('optionsGaranties')->get();
        return response()->json($garanties);
    }

    public function getOptions($id)
    {
        $options = OptionGarantie::where('garantie_id', $id)->get();
        return response()->json($options);
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
    public function show(TypeGarantie $typeGarantie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeGarantie $typeGarantie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeGarantie $typeGarantie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeGarantie $typeGarantie)
    {
        //
    }
}
