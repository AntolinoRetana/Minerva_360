<?php

namespace App\Http\Controllers;

use App\Models\Donacion;
use App\Models\Donante;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class DonacionController extends Controller
{
    // Listar todas las donaciones
    public function index()
    {
        $donaciones = Donacion::with(['donante', 'proyecto'])
            ->orderBy('fecha', 'desc')
            ->paginate(15);

        return view('donaciones.index', compact('donaciones'));
    }

    // Mostrar formulario para crear donación
    public function create()
    {
        $donantes = Donante::orderBy('nombre')->get();
        $proyectos = Proyecto::where('estado', 'Activo')->orderBy('nombre')->get();

        return view('donaciones.create', compact('donantes', 'proyectos'));
    }

    // Guardar nueva donación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donante_id' => 'required|exists:donantes,id',
            'proyecto_id' => 'required|exists:proyectos,id',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'metodo_pago' => 'required|in:Efectivo,Transferencia,Paypal',
        ], [
            'donante_id.required' => 'Debe seleccionar un donante',
            'donante_id.exists' => 'El donante seleccionado no existe',
            'proyecto_id.required' => 'Debe seleccionar un proyecto',
            'proyecto_id.exists' => 'El proyecto seleccionado no existe',
            'monto.required' => 'El monto es obligatorio',
            'monto.numeric' => 'El monto debe ser un número',
            'monto.min' => 'El monto debe ser mayor a 0',
            'fecha.required' => 'La fecha es obligatoria',
            'fecha.date' => 'La fecha no es válida',
            'metodo_pago.required' => 'Debe seleccionar un método de pago',
            'metodo_pago.in' => 'El método de pago no es válido',
        ]);

        // Crear la donación
        $donacion = Donacion::create($validated);

        // Actualizar el progreso del proyecto
        $proyecto = Proyecto::find($validated['proyecto_id']);
        $proyecto->progreso += $validated['monto'];

        // Si el progreso alcanza o supera la meta, marcar como completado
        if ($proyecto->progreso >= $proyecto->meta) {
            $proyecto->estado = 'Completado';
        }

        $proyecto->save();

        return redirect()->route('donaciones.index')
            ->with('success', 'Donación registrada exitosamente');
    }

    // Mostrar detalles de una donación
    public function show(Donacion $donacion)
    {
        $donacion->load(['donante', 'proyecto']);

        return view('donaciones.show', compact('donacion'));
    }

    // Mostrar formulario de edición
    public function edit(Donacion $donacion)
    {
        $donantes = Donante::orderBy('nombre')->get();
        $proyectos = Proyecto::orderBy('nombre')->get();

        return view('donaciones.edit', compact('donacion', 'donantes', 'proyectos'));
    }

    // Actualizar donación
    public function update(Request $request, Donacion $donacion)
    {
        $montoAnterior = $donacion->monto;
        $proyectoAnterior = $donacion->proyecto_id;

        $validated = $request->validate([
            'donante_id' => 'required|exists:donantes,id',
            'proyecto_id' => 'required|exists:proyectos,id',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'metodo_pago' => 'required|in:Efectivo,Transferencia,Paypal',
        ]);

        // Actualizar la donación
        $donacion->update($validated);

        // Ajustar progreso del proyecto anterior
        if ($proyectoAnterior != $validated['proyecto_id']) {
            $proyectoViejo = Proyecto::find($proyectoAnterior);
            $proyectoViejo->progreso -= $montoAnterior;
            $proyectoViejo->save();
        }

        // Ajustar progreso del proyecto nuevo
        $proyectoNuevo = Proyecto::find($validated['proyecto_id']);
        if ($proyectoAnterior == $validated['proyecto_id']) {
            $proyectoNuevo->progreso = $proyectoNuevo->progreso - $montoAnterior + $validated['monto'];
        } else {
            $proyectoNuevo->progreso += $validated['monto'];
        }

        if ($proyectoNuevo->progreso >= $proyectoNuevo->meta) {
            $proyectoNuevo->estado = 'Completado';
        }

        $proyectoNuevo->save();

        return redirect()->route('donaciones.index')
            ->with('success', 'Donación actualizada exitosamente');
    }

    // Eliminar donación
    public function destroy(Donacion $donacion)
    {
        $proyecto = $donacion->proyecto;
        $proyecto->progreso -= $donacion->monto;
        $proyecto->save();

        $donacion->delete();

        return redirect()->route('donaciones.index')
            ->with('success', 'Donación eliminada exitosamente');
    }
}
