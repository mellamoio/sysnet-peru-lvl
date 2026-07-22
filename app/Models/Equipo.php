<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    use SoftDeletes;
    protected $table = 'equipos';
    protected $fillable = ['imei', 'modelo_id', 'estado_id', 'disponible', 'observaciones'];
    protected function casts(): array { return ['disponible' => 'boolean']; }

    public function modelo() { return $this->belongsTo(Modelo::class); }
    public function estado() { return $this->belongsTo(EstadoEquipo::class, 'estado_id'); }
    public function tipoProducto()
    {
        // Accede al tipo de producto a través de la relación con Modelo
        return $this->hasOneThrough(
            TipoProducto::class,
            Modelo::class,
            'id',               // Clave primaria en modelos
            'id',               // Clave primaria en tipo_productos
            'modelo_id',        // Clave foránea en equipos
            'tipo_producto_id'  // Clave foránea en modelos
        );
    }
}
