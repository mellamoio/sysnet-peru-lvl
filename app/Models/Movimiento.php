<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $fillable = ['fecha_movimiento', 'tipo_movimiento_id', 'usuario_id', 'tecnico_id', 'cliente_id', 'proveedor_id', 'ruta_documento', 'numero_documento', 'observaciones'];
    protected function casts(): array { return ['fecha' => 'fecha_movimiento']; }

    public function detalles() { return $this->hasMany(MovimientoDetalle::class); }
    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
