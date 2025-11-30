@extends('layouts.app')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2-institucional mb-0">Editar Proyecto</h1>
        <div>
            <!-- Botón "Volver" con estilo secundario -->
            <a href="{{ route('proyectos.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Volver al Listado</span>
            </a>
        </div>
    </div>

    <!-- Contenedor para el formulario de Livewire -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4 p-md-5">
            
            <!-- Título dentro de la tarjeta -->
            <h5 class="card-title fw-bold mb-4">
                Editando: <span class="text-brand-text">{{ $proyecto->nombre }}</span>
            </h5>

            <!-- Aquí se renderizará tu formulario de Livewire -->
            <!-- Pasamos el ID del proyecto al componente -->
            <livewire:proyecto-edit :proyecto-id="$proyecto->id" />
        </div>
    </div>

@endsection