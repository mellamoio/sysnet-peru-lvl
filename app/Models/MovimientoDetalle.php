<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoDetalle extends Model
{
    protected $table = 'movimiento_detalles';
    protected $fillable = ['movimiento_id', 'equipo_id', 'estado_anterior', 'estado_nuevo'];
}
