<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoProducto;

class AlmacenController extends Controller
{
    public function indexMarcasModelos()
    {   
        $marcas = Marca::all();
        $modelos = Modelo::with('marca')->get();
        $tiposProducto = TipoProducto::all(); 
        //return $marcas;
        //return $modelos;
        return view('marcas_y_modelos.index', compact('marcas','modelos','tiposProducto'));
    }
}
