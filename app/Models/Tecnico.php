<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $table = 'tecnicos';
    protected $fillable = ['nombre', 'dni', 'telefono', 'estado'];
    protected function casts(): array { return ['estado' => 'boolean']; }
}
