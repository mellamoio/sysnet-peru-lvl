<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
        //return $proveedores;
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
            'razon_social' => 'required|string|max:255',
            'ruc' => 'required|string|max:11|unique:proveedores,ruc',
            'telefono' => 'required|string|max:9',
            'estado' => 'boolean'
        ]);

        Proveedor::create([
            'razon_social' => $request->razon_social,
            'ruc' => $request->ruc,
            'telefono' => $request->telefono,
            'estado' => $request->boolean('estado'),
        ]);


        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor creado correctamente.');
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
    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'razon_social' => 'required|string|max:255',
            'ruc' => 'required|string|max:11|unique:proveedores,ruc,' . $proveedor->id,
            'telefono' => 'required|string|max:9',
            'estado' => 'boolean'
        ]);


        $data = [
            'razon_social' => $request->razon_social,
            'ruc' => $request->ruc,
            'telefono' => $request->telefono,
            'estado' => $request->boolean('estado'),
        ];

        $proveedor->update($data);

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor eliminado correctamente.');
    }
}
