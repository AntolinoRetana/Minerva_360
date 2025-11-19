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

    public function index(Request $request): View
    {
        $imagenesProyectos = ImagenProyecto::paginate();

        return view('imagenes-proyecto.index', compact('imagenesProyectos'))
            ->with('i', ($request->input('page', 1) - 1) * $imagenesProyectos->perPage());
    }

    public function create(Request $request): View
    {
        $imagenesProyecto = new ImagenProyecto();
        $imagenesProyecto->proyecto_id = $request->proyecto_id;

        $proyecto = \App\Models\Proyecto::find($request->proyecto_id);

        return view('imagenes-proyecto.create', compact('imagenesProyecto', 'proyecto'));
    }

    public function store(ImagenesProyectoRequest $request): RedirectResponse
    {
        // 1) Calcular orden incremental
        $ultimo = ImagenProyecto::where('proyecto_id', $request->proyecto_id)
                    ->orderBy('orden', 'desc')
                    ->first();

        $nuevoOrden = $ultimo ? $ultimo->orden + 1 : 1;

        // 2) Archivo
        $file = $request->file('imagen');

        // 3) Nombre único
        $fileName = time() . '_' . $file->getClientOriginalName();

        // 4) Carpeta por proyecto en Supabase
        $path = "proyectos/{$request->proyecto_id}/{$fileName}";

        // 5) Subir al bucket
        $urlPublica = $this->storage->upload($file, $path);

        // 6) Guardar en DB
        ImagenProyecto::create([
            'proyecto_id' => $request->proyecto_id,
            'url' => $urlPublica,
            'orden' => $nuevoOrden,
        ]);

        return Redirect::route('imagenes-proyecto.index')
            ->with('success', 'Imagen creada correctamente.');
    }

    public function show($id): View
    {
        $imagenesProyecto = ImagenProyecto::find($id);

        return view('imagenes-proyecto.show', compact('imagenesProyecto'));
    }

    public function edit($id): View
    {
        $imagenesProyecto = ImagenProyecto::find($id);

        return view('imagenes-proyecto.edit', compact('imagenesProyecto'));
    }

    public function update(ImagenesProyectoRequest $request, ImagenProyecto $imagenesProyecto): RedirectResponse
    {
        $imagenesProyecto->update([
            'proyecto_id' => $request->proyecto_id,
            'orden' => $request->orden,
        ]);

        return Redirect::route('imagenes-proyecto.index')
            ->with('success', 'Imagen actualizada correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        ImagenProyecto::find($id)->delete();

        return Redirect::route('imagenes-proyecto.index')
            ->with('success', 'Imagen eliminada correctamente.');
    }
}
