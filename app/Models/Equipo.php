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
}
