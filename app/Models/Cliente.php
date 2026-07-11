<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['razon_social', 'ruc', 'direccion', 'telefono', 'estado'];
    protected function casts(): array { return ['estado' => 'boolean']; }
}
