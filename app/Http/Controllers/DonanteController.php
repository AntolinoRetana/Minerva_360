<?php

namespace App\Http\Controllers;

use App\Models\Donante;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DonanteController extends Controller
{
    // Listar todos los donantes
    public function index()
    {
        $donantes = Donante::withCount('donaciones')
            ->with(['donaciones' => function($query) {
                $query->selectRaw('donante_id, SUM(monto) as total_donado')
                    ->groupBy('donante_id');
            }])
            ->paginate(10);

        return view('donantes.index', compact('donantes'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('donantes.create');
    }

    // Guardar nuevo donante
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|unique:donantes,correo',
            'usuario' => 'required|string|unique:donantes,usuario|max:255',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'correo.required' => 'El correo es obligatorio',
            'correo.email' => 'El correo debe ser válido',
            'correo.unique' => 'Este correo ya está registrado',
            'usuario.required' => 'El usuario es obligatorio',
            'usuario.unique' => 'Este usuario ya existe',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Donante::create($validated);

        return redirect()->route('donantes.index')
            ->with('success', 'Donante creado exitosamente');
    }

    // Mostrar detalles de un donante
    public function show(Donante $donante)
    {
        $donante->load(['donaciones.proyecto']);
        $totalDonado = $donante->donaciones->sum('monto');

        return view('donantes.show', compact('donante', 'totalDonado'));
    }

    // Mostrar formulario de edición
    public function edit(Donante $donante)
    {
        return view('donantes.edit', compact('donante'));
    }

    // Actualizar donante
    public function update(Request $request, Donante $donante)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|unique:donantes,correo,' . $donante->id,
            'usuario' => 'required|string|unique:donantes,usuario,' . $donante->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $donante->update($validated);

        return redirect()->route('donantes.index')
            ->with('success', 'Donante actualizado exitosamente');
    }

    // Eliminar donante
    public function destroy(Donante $donante)
    {
        $donante->delete();

        return redirect()->route('donantes.index')
            ->with('success', 'Donante eliminado exitosamente');
    }
}
