<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoDetalle extends Model
{
    protected $table = 'movimiento_detalles';
    
    protected $fillable = [
        'movimiento_id', 
        'equipo_id', 
        'estado_anterior', // El ID del estado que tenía el equipo ANTES del movimiento
        'estado_nuevo'     // El ID del estado que se le asignó DESPUÉS del movimiento
    ];

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function estadoAnterior()
    {
        return $this->belongsTo(EstadoEquipo::class, 'estado_anterior');
    }

    public function estadoNuevo()
    {
        return $this->belongsTo(EstadoEquipo::class, 'estado_nuevo');
    }
}
