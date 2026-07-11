<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialEquipo extends Model
{
    protected $table = 'historial_equipos';
    protected $fillable = ['equipo_id', 'movimiento_detalle_id', 'fecha', 'observacion'];
    protected function casts(): array { return ['fecha' => 'datetime']; }
}
