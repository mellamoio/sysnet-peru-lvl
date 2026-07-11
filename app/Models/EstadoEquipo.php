<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoEquipo extends Model
{
    protected $table = 'estados_equipos'; // Ajustado al plural estándar
    protected $fillable = ['nombre'];
}
