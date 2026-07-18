<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tecnicos = Tecnico::all();

        // return $tecnicos;
        return view('tecnicos.index', compact('tecnicos'));
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
            'dni' => 'required|string|max:12|unique:tecnicos,dni',
            'telefono' => 'required|string|max:9',
            'estado' => 'boolean'
        ]);

        Tecnico::create([
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'estado' => $request->boolean('estado'),
        ]);


        return redirect()->route('tecnicos.index')
                         ->with('success', 'Técnico creado correctamente.');
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
    public function edit(Tecnico $tecnico)
    {
        return view('tecnicos.edit', compact('tecnico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tecnico $tecnico)
    {
 
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dni' => 'required|string|max:12|unique:tecnicos,dni,' . $tecnico->id,
            'telefono' => 'required|string|max:9',
            'estado' => 'boolean'
        ]);


        $data = [
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'estado' => $request->boolean('estado'),
        ];

        $tecnico->update($data);

        return redirect()->route('tecnicos.index')
                         ->with('success', 'Técnico actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tecnico $tecnico)
    {
        $tecnico->delete();

        return redirect()->route('tecnicos.index')
                         ->with('success', 'Técnico eliminado correctamente.');
    }
}
