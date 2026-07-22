<?php

namespace App\Http\Controllers;

use App\Exports\PlantillaEquiposExport;
use App\Imports\EquiposImport;
use App\Models\Equipo;
use App\Models\EstadoEquipo;
use App\Models\Modelo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = Modelo::all();
        $estadosEquipo = EstadoEquipo::all();
        $equipos = Equipo::with('estado', 'modelo.marca', 'tipoProducto')->inRandomOrder()->get();

        return view('equipos.index', compact('equipos', 'modelos', 'estadosEquipo'));
        // return $equipos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modelos = Modelo::all();
        $estadosEquipo = EstadoEquipo::all();

        return view('equipos.create', compact('modelos', 'estadosEquipo'));
        // return $estadosEquipo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'imei' => 'required|numeric|digits_between:14,18|unique:equipos,imei',
            'modelo_id' => 'required|exists:modelos,id',
            'estado_id' => 'required|exists:estados_equipos,id', // Cambia 'estado_equipos' según el nombre de tu tabla
            'disponible' => 'required|boolean',
            'observaciones' => 'nullable|string',
        ], [

            'imei.required' => 'El número de IMEI es obligatorio.',
            'imei.numeric' => 'El IMEI solo debe contener números.',
            'imei.digits_between' => 'El IMEI debe tener entre 14 y 18 dígitos.',
            'imei.unique' => 'Este número de IMEI ya se encuentra registrado en el sistema.',
            'modelo_id.required' => 'Debe seleccionar un modelo de equipo.',
            'modelo_id.exists' => 'El modelo seleccionado no existe.',
            'estado_id.required' => 'Debe seleccionar el estado del equipo.',
            'disponible.required' => 'Debe indicar la disponibilidad del equipo.',
        ]);

        Equipo::create([
            'imei' => $validatedData['imei'],
            'modelo_id' => $validatedData['modelo_id'],
            'estado_id' => $validatedData['estado_id'],
            'disponible' => $validatedData['disponible'],
            'observaciones' => $validatedData['observaciones'],
        ]);

        // 3. Redirección con mensaje flash
        return redirect()->route('equipos.create')
            ->with('success', 'Equipo registrado correctamente.');
    }

    public function storeBatch(Request $request)
    {

        $request->validate([
            'equipos' => 'required|array|min:1',
            'equipos.*.imei' => 'required|numeric|digits_between:14,18|distinct|unique:equipos,imei',
            'equipos.*.modelo_id' => 'required|exists:modelos,id',
            'equipos.*.estado_id' => 'required|exists:estados_equipos,id', // Ajusta el nombre de tu tabla
            'equipos.*.disponible' => 'required|boolean',
            'equipos.*.observaciones' => 'nullable|string|max:500',
        ], [
            'equipos.*.imei.required' => 'El IMEI es obligatorio en todas las filas.',
            'equipos.*.imei.distinct' => 'Hay IMEIs repetidos dentro del formulario que intentas registrar.',
            'equipos.*.imei.unique' => 'Uno o más IMEIs ya se encuentran registrados previamente en el sistema.',
            'equipos.*.modelo_id.required' => 'Debe seleccionar un modelo para cada equipo.',
            'equipos.*.estado_id.required' => 'Debe seleccionar el estado para cada equipo.',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->equipos as $item) {
                Equipo::create([
                    'imei' => $item['imei'],
                    'modelo_id' => $item['modelo_id'],
                    'estado_id' => $item['estado_id'],
                    'disponible' => $item['disponible'],
                    'observaciones' => $item['observaciones'] ?? null,
                ]);
            }
        });

        $total = count($request->equipos);

        return redirect()->route('equipos.create')
            ->with('success', "¡Se registraron exitosamente {$total} equipos!");
    }

    public function importExcel(Request $request)
    {
        // Validar que se haya adjuntado un archivo válido
        $request->validate([
            'archivo_excel' => 'required|mimes:xlsx,xls,csv|max:10240', // Máx 10MB
        ], [
            'archivo_excel.required' => 'Por favor selecciona un archivo Excel.',
            'archivo_excel.mimes' => 'El archivo debe ser un formato válido (.xlsx, .xls, .csv).',
            'archivo_excel.max' => 'El archivo no debe superar los 10 MB.',
        ]);

        try {
            Excel::import(new EquiposImport, $request->file('archivo_excel'));

            return response()->json([
                'status' => 'success',
                'message' => '¡El archivo Excel fue procesado y los equipos se importaron con éxito!',
            ], 200);

        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];

            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: ".implode(', ', $failure->errors());
            }

            return response()->json([
                'status' => 'validation_error',
                'errors' => $errorMessages,
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error al procesar el archivo: '.$e->getMessage(),
            ], 500);
        }
    }

    public function descargarPlantilla()
    {
        return Excel::download(new PlantillaEquiposExport, 'plantilla_importacion_equipos.xlsx');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        $equipo->load(['estado', 'modelo.marca', 'modelo.tipoProducto']);
        return view('equipos.show', compact('equipo'));
    }

    public function descargarPdf(Equipo $equipo)
    {

        $equipo->load(['estado', 'modelo.marca', 'modelo.tipoProducto']);

        $pdf = Pdf::loadView('equipos.pdf', compact('equipo'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('ficha_equipo_'.$equipo->imei.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        return $equipo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        $validatedData = $request->validate([
            'imei' => [
                'required',
                'numeric',
                'digits_between:14,18',
                Rule::unique('equipos', 'imei')->ignore($equipo->id),
            ],
            'modelo_id' => 'required|exists:modelos,id',
            'estado_id' => 'required|exists:estados_equipos,id',
            'disponible' => 'required|boolean',
            'observaciones' => 'nullable|string',
        ], [
            'imei.required' => 'El número de IMEI es obligatorio.',
            'imei.numeric' => 'El IMEI solo debe contener números.',
            'imei.digits_between' => 'El IMEI debe tener entre 14 y 18 dígitos.',
            'imei.unique' => 'Este número de IMEI ya se encuentra registrado en otro equipo.',
            'modelo_id.required' => 'Debe seleccionar un modelo de equipo.',
            'modelo_id.exists' => 'El modelo seleccionado no existe.',
            'estado_id.required' => 'Debe seleccionar el estado del equipo.',
            'disponible.required' => 'Debe indicar la disponibilidad del equipo.',
        ]);

        $equipo->update($validatedData);

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}
