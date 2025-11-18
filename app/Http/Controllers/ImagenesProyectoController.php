<?php

namespace App\Http\Controllers;

use App\Models\ImagenesProyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ImagenesProyectoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ImagenesProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $imagenesProyectos = ImagenesProyecto::paginate();

        return view('imagenes-proyecto.index', compact('imagenesProyectos'))
            ->with('i', ($request->input('page', 1) - 1) * $imagenesProyectos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $imagenesProyecto = new ImagenesProyecto();

        return view('imagenes-proyecto.create', compact('imagenesProyecto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImagenesProyectoRequest $request): RedirectResponse
    {
        ImagenesProyecto::create($request->validated());

        return Redirect::route('imagenes-proyectos.index')
            ->with('success', 'ImagenesProyecto created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $imagenesProyecto = ImagenesProyecto::find($id);

        return view('imagenes-proyecto.show', compact('imagenesProyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $imagenesProyecto = ImagenesProyecto::find($id);

        return view('imagenes-proyecto.edit', compact('imagenesProyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImagenesProyectoRequest $request, ImagenesProyecto $imagenesProyecto): RedirectResponse
    {
        $imagenesProyecto->update($request->validated());

        return Redirect::route('imagenes-proyectos.index')
            ->with('success', 'ImagenesProyecto updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ImagenesProyecto::find($id)->delete();

        return Redirect::route('imagenes-proyectos.index')
            ->with('success', 'ImagenesProyecto deleted successfully');
    }
}
