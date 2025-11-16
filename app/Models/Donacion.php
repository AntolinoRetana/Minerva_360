<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    protected $table = 'donaciones';

    protected $fillable = [
        'donante_id',
        'proyecto_id',
        'monto',
        'fecha',
        'metodo_pago',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function donante()
    {
        return $this->belongsTo(Donante::class, 'donante_id');
    }
}
