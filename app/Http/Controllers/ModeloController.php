<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ModeloController extends Controller
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
            'marca_id' => 'required|exists:marcas,id',
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
            'url_imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $rutaImagen = null;

        // Capturamos el archivo de forma nativa
        if ($request->hasFile('url_imagen') && $request->file('url_imagen')->isValid()) {
            $rutaImagen = $request->file('url_imagen')->store('modelos', 'public');
        }

        Modelo::create([
            'nombre' => $request->nombre,
            'marca_id' => $request->marca_id,
            'tipo_producto_id' => $request->tipo_producto_id,
            'url_imagen' => $rutaImagen, // O 'url_imagen' según el nombre de tu columna en BD
        ]);

        return redirect()->route('marcas_y_modelos.index')
            ->with('success', 'Modelo creado correctamente.');

        /*
        $request->validate([
        'nombre' => 'required|string|max:255',
        'marca_id' => 'required|exists:marcas,id',
        'url_imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $rutaImagen = null;

    // Verificamos si realmente llegó un archivo válido y no un objeto vacío
    if ($request->hasFile('url_imagen') && $request->file('url_imagen')->isValid()) {
        $rutaImagen = $request->file('url_imagen')->store('modelos', 'public');
    }

    Modelo::create([
        'nombre' => $request->nombre,
        'marca_id' => $request->marca_id,
        'imagen' => $rutaImagen,
    ]);

    if ($request->ajax()) {
        return response()->json(['message' => 'Guardado exitoso']);
    }

    return redirect()->route('marcas_y_modelos.index')
                     ->with('success', 'Modelo creado correctamente.');
        */

        /* $request->validate([
            'nombre' => 'required|string|max:255',
            'marca_id' => 'required|exists:marcas,id'
        ]);

        Modelo::create([
            'nombre' => $request->nombre,
            'marca_id' => $request->marca_id,
        ]);


        return redirect()->route('marcas_y_modelos.index')
                         ->with('success', 'Modelo creado correctamente.'); */

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
    public function update(Request $request, Modelo $modelo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca_id' => 'required|exists:marcas,id',
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
            'url_imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Mantenemos la ruta de la imagen que ya tenía por defecto
        $rutaImagen = $modelo->url_imagen;

        // Si subió una nueva imagen válida
        if ($request->hasFile('url_imagen') && $request->file('url_imagen')->isValid()) {
            
            // 1. Eliminamos la imagen anterior del disco para no acumular basura
            if ($modelo->url_imagen && Storage::disk('public')->exists($modelo->url_imagen)) {
                Storage::disk('public')->delete($modelo->url_imagen);
            }

            // 2. Guardamos la nueva imagen
            $rutaImagen = $request->file('url_imagen')->store('modelos', 'public');
        }

        // Actualizamos los datos
        $modelo->update([
            'nombre' => $request->nombre,
            'marca_id' => $request->marca_id,
            'tipo_producto_id' => $request->tipo_producto_id,
            'url_imagen' => $rutaImagen,
        ]);

        return redirect()->route('marcas_y_modelos.index')
            ->with('success', 'Modelo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelo $modelo)
    {

        if ($modelo->url_imagen && Storage::disk('public')->exists($modelo->url_imagen)) {
            Storage::disk('public')->delete($modelo->url_imagen);
        }

        $modelo->delete();

        return redirect()->route('marcas_y_modelos.index')
            ->with('success', 'Modelo eliminado correctamente.');
    }
}
