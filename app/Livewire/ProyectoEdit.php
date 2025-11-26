<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;

class ProyectoEdit extends Component
{
    public $proyectoId;

    public $nombre, $descripcion, $carrera, $ubicacion;
    public $meta, $progreso, $estado;

    public function mount($proyectoId)
    {
        $proyecto = Proyecto::findOrFail($proyectoId);

        $this->proyectoId  = $proyecto->id;
        $this->nombre      = $proyecto->nombre;
        $this->descripcion = $proyecto->descripcion;
        $this->carrera     = $proyecto->carrera;
        $this->ubicacion   = $proyecto->ubicacion;
        $this->meta        = $proyecto->meta;
        $this->progreso    = $proyecto->progreso;
        $this->estado      = $proyecto->estado;
    }

    public function actualizar()
    {
        $this->validate([
            'nombre'    => 'required|string|max:255',
            'meta'      => 'required|numeric|min:0',
            'progreso'  => 'nullable|numeric|min:0',
            'estado'    => 'required|in:Activo,Completado',
        ]);

        $proyecto = Proyecto::findOrFail($this->proyectoId);

        $proyecto->update([
            'nombre'      => $this->nombre,
            'descripcion' => $this->descripcion,
            'carrera'     => $this->carrera,
            'ubicacion'   => $this->ubicacion,
            'meta'        => $this->meta,
            'progreso'    => $this->progreso,
            'estado'      => $this->estado,
        ]);

        session()->flash('success', 'Proyecto actualizado correctamente.');
        return redirect()->route('proyectos.index');
    }


    public function render()
    {
        return view('livewire.proyecto-edit');
    }
}
