<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Donante extends Authenticatable
{
    protected $table = 'donantes';

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'usuario',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function donaciones()
    {
        return $this->hasMany(Donacion::class, 'donante_id');
    }


}
