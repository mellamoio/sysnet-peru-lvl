<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $fillable = ['fecha', 'tipo_movimiento_id', 'usuario_id', 'tecnico_id', 'cliente_id', 'proveedor_id', 'numero_documento', 'observaciones'];
    protected function casts(): array { return ['fecha' => 'datetime']; }

    public function detalles() { return $this->hasMany(MovimientoDetalle::class); }
}
