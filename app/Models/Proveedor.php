<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = ['razon_social', 'ruc', 'telefono', 'estado'];
    protected function casts(): array { return ['estado' => 'boolean']; }
}
