<?php

namespace App\Http\Controllers;

use App\Models\ImagenProyecto;
use App\Services\SupabaseStorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ImagenesProyectoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ImagenesProyectoController extends Controller
{
    protected $storage;

    public function __construct(SupabaseStorageService $storage)
    {
        $this->storage = $storage;
    }

    public function create(Request $request): View
    {
        $imagenesProyecto = new ImagenProyecto();
        $imagenesProyecto->proyecto_id = $request->proyecto_id;

        $proyecto = \App\Models\Proyecto::findOrFail($request->proyecto_id);

        return view('imagenes-proyecto.create', compact('imagenesProyecto', 'proyecto'));
    }

    public function store(ImagenesProyectoRequest $request): RedirectResponse
    {
        // Calcular orden incremental
        $ultimo = ImagenProyecto::where('proyecto_id', $request->proyecto_id)
            ->orderBy('orden', 'desc')
            ->first();

        $nuevoOrden = $ultimo ? $ultimo->orden + 1 : 1;

        // Archivo
        $file = $request->file('imagen');

        // Nombre único
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Carpeta en supabase
        $path = "proyectos/{$request->proyecto_id}/{$fileName}";

        // Subir
        $urlPublica = $this->storage->upload($file, $path);

        // Insert DB
        ImagenProyecto::create([
            'proyecto_id' => $request->proyecto_id,
            'url'        => $urlPublica,
            'orden'      => $nuevoOrden,
        ]);

        return back()->with('success', 'Imagen subida correctamente.');
    }

    public function porProyecto($proyecto_id): View
    {
        $proyecto = \App\Models\Proyecto::findOrFail($proyecto_id);

        $imagenes = ImagenProyecto::where('proyecto_id', $proyecto_id)
            ->orderBy('orden', 'asc')
            ->get();

        return view('imagenes-proyecto.por-proyecto', compact('proyecto', 'imagenes'));
    }

    public function eliminarImagen($id): RedirectResponse
    {
        $imagen = ImagenProyecto::find($id);

        if (!$imagen) {
            return back()->with('error', 'La imagen no existe.');
        }

        $imagen->delete();

        return back()->with('success', 'Imagen eliminada correctamente.');
    }
}
