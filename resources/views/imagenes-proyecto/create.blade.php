@extends('layouts.app')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold h2-institucional mb-1">Subir Imagen</h1>
            <p class="text-muted mb-0">
                Añadir recursos visuales al proyecto <strong class="text-brand-text">{{ $proyecto->nombre }}</strong>
            </p>
        </div>
        <div>
            <!-- Botón "Volver" -->
            <a href="{{ route('proyectos.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Volver</span>
            </a>
        </div>
    </div>

    <!-- Contenedor del Formulario -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4 p-md-5">
            
            <form method="POST" action="{{ route('imagenes-proyecto.store') }}" enctype="multipart/form-data" id="uploadForm">
                @csrf

                <!-- Si tu controlador espera el ID del proyecto -->
                <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">

                <div class="row g-4">
                    
                    <!-- Campo Informativo: Proyecto -->
                    <div class="col-12">
                        <label class="form-label label-t fw-medium">Proyecto</label>
                        <input type="text" 
                               class="form-control bg-light" 
                               value="{{ $proyecto->nombre }}" 
                               readonly 
                               disabled>
                        <small class="text-muted">Estás subiendo una imagen para este proyecto específico.</small>
                    </div>

                    <!-- Campo: Selección de Imagen -->
                    <div class="col-12">
                        <label for="imagen" class="form-label label-t fw-medium">Imagen del proyecto</label>
                        <div class="input-group">
                            <input type="file" 
                                   name="imagen" 
                                   id="imagen" 
                                   class="form-control @error('imagen') is-invalid @enderror"
                                   accept="image/*"> <!-- Restringe a solo imágenes -->
                            <label class="input-group-text" for="imagen">
                                <i class="bi bi-image"></i>
                            </label>
                        </div>
                        @error('imagen')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">
                            Formatos permitidos: JPG, PNG, JPEG. Tamaño máximo recomendado: 2MB.
                        </div>
                    </div>

                </div>

                <!-- Botones de Acción -->
                <hr class="my-4">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('proyectos.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="bi bi-cloud-upload-fill"></i>
                        <span>Guardar Imagen</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection

