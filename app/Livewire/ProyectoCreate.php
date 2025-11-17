<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;

class ProyectoCreate extends Component
{
    public $nombre, $descripcion, $carrera, $ubicacion;
    public $meta = 0;

    public function guardar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'meta'   => 'required|numeric|min:0',
        ]);

        Proyecto::create([
            'nombre'      => $this->nombre,
            'descripcion' => $this->descripcion,
            'carrera'     => $this->carrera,
            'ubicacion'   => $this->ubicacion,
            'meta'        => $this->meta,
            'progreso'    => 0,
            'estado'      => 'Activo',
        ]);

        session()->flash('success', 'Proyecto creado correctamente');

        return redirect()->route('proyectos.index');
    }

    public function render()
    {
        return view('livewire.proyecto-create');
    }
}
