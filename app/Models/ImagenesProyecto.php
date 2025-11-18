<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImagenesProyecto
 *
 * @property $id
 * @property $proyecto_id
 * @property $url
 * @property $orden
 * @property $created_at
 * @property $updated_at
 *
 * @property Proyecto $proyecto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ImagenesProyecto extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['proyecto_id', 'url', 'orden'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proyecto()
    {
        return $this->belongsTo(\App\Models\Proyecto::class, 'proyecto_id', 'id');
    }
    
}
