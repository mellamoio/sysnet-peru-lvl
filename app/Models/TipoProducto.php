<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoProducto extends Model
{
    use SoftDeletes;
    protected $table = 'tipo_productos';
    protected $fillable = ['nombre', 'descripcion'];
}
