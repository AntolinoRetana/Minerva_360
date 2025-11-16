<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenProyecto extends Model
{
    protected $table = 'imagenes_proyecto';

    protected $fillable = [
        'proyecto_id',
        'url',
        'orden',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
