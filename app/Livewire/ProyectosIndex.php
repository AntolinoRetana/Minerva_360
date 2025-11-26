<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;

class ProyectosIndex extends Component
{
    public $search = '';
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
        $proyectos = Proyecto::query()
            ->withSum('donaciones as total_donado', 'monto')
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('carrera', 'like', '%' . $this->search . '%')
                    ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('livewire.proyectos-index', compact('proyectos'));
    }

    public function editarProyecto($id)
    {
        return redirect()->route('proyectos.editar', $id);
    }
}
