<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'boolean'
        ]);

        Marca::create([
            'nombre' => $request->nombre,
            'estado' => $request->boolean('estado'),
        ]);


        return redirect()->route('marcas_y_modelos.index')
                         ->with('success', 'Marca creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $marca->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('marcas_y_modelos.index')
            ->with('success', 'Marca actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
