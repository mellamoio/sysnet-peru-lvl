<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';
    protected $fillable = ['razon_social', 'ruc', 'direccion', 'telefono', 'estado'];
    protected function casts(): array { return ['estado' => 'boolean']; }
}
