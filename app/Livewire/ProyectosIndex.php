<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;

class ProyectosIndex extends Component
{
    protected $listeners = ['eliminarProyecto'];

    public function eliminarProyecto($id)
    {
    
        $proyecto = Proyecto::find($id);

        if ($proyecto) {
            $proyecto->delete();
            session()->flash('success', 'Proyecto eliminado correctamente');

            return redirect()->route('proyectos.index');
        }
    }

    public function render()
    {
        $proyectos = Proyecto::orderBy('id', 'asc')->get();

        return view('livewire.proyectos-index', compact('proyectos'));
    }

    public function editarProyecto($id)
    {
        return redirect()->route('proyectos.editar', $id);
    }
}
