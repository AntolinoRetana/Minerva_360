<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'carrera',
        'ubicacion',
        'meta',
        'progreso',
        'estado',
    ];

    public function imagenes()
    {
        return $this->hasMany(ImagenProyecto::class, 'proyecto_id');
    }

    public function donaciones()
    {
        return $this->hasMany(Donacion::class, 'proyecto_id');
    }

    public function totalDonado()
    {
        return $this->donaciones()->sum('monto');
    }

}
