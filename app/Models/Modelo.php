<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use SoftDeletes;
    protected $table = 'modelos';
    protected $fillable = ['marca_id', 'tipo_producto_id', 'nombre', 'url_imagen'];

    public function marca() { return $this->belongsTo(Marca::class)->withTrashed(); }
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'tipo_producto_id');
    }
    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }
}
