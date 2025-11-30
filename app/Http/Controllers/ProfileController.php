<?php

namespace App\Http\Controllers;

use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request, SupabaseStorageService $supabase)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();

        // Subir nueva foto si viene
        if ($request->hasFile('photo')) {

        // Eliminar foto anterior
        if ($user->profile_photo_path) {
            $supabase->delete($user->profile_photo_path);
        }

        $file = $request->file('photo');

        // Generar nombre único
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Enviar ruta completa con nombre al servicio
        $relativePath = "profile_photos/{$filename}";

        // Subir
        $supabase->upload($file, $relativePath);

        // Guardar solo la ruta relativa (NO la URL completa)
        $user->profile_photo_path = $relativePath;

        
    }


        // Actualizar nombre + correo
        $user->name  = $request->name;
        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function show()
    {
        return view('profile.show', [
            'user' => auth()->user(),
        ]);
    }

    // Método para mostrar el formulario de EDICIÓN
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    }
  

}