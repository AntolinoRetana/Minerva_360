@extends('layouts.app')

@php($title = 'Detalle Donación')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2-institucional mb-0">Detalles de la Donación</h1>
        <div class="d-flex gap-2">
            <!-- Botón "Editar" con estilo secundario -->
            <a href="{{ route('donaciones.edit', $donacion) }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-pencil-fill"></i>
                <span>Editar</span>
            </a>
            <!-- Botón "Volver" -->
            <a href="{{ route('donaciones.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Volver</span>
            </a>
        </div>
    </div>

    <!-- Fila de Estadísticas Principales -->
    <div class="row g-4 mb-4">
        <!-- Widget 1: Total Donado -->
        <div class="col-md-6">
            <div class="card stat-card-simple border-start-success">
                <p class="text-muted mb-1">Monto Donado</p>
                <h2 class="fw-bold text-success mb-0">
                    ${{ number_format($donacion->monto, 2) }}
                </h2>
            </div>
        </div>
        <!-- Widget 2: Fecha -->
        <div class="col-md-6">
            <div class="card stat-card-simple border-start-secondary">
                <p class="text-muted mb-1">Fecha de Donación</p>
                <h2 class="fw-bold text-secondary-emphasis mb-0">
                    {{ \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') }}
                </h2>
            </div>
        </div>
    </div>

    <!-- Fila de Información (Donante y Proyecto) -->
    <div class="row g-4 mb-4">
        
        <!-- Tarjeta de Donante -->
        <div class="col-lg-6">
            <div class="card card-bg-light-azul h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">Donante</h5>
                    <div class="mb-2">
                        <p class="text-muted small mb-0">Nombre</p>
                        <p class="fw-semibold">{{ $donacion->donante->nombre }} {{ $donacion->donante->apellido }}</p>
                    </div>
                    <div class="mb-2">
                        <p class="text-muted small mb-0">Correo</p>
                        <p class="fw-medium">{{ $donacion->donante->correo }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted small mb-0">Teléfono</p>
                        <p class="fw-medium">{{ $donacion->donante->telefono ?? 'No registrado' }}</p>
                    </div>
                    <a href="{{ route('donantes.show', $donacion->donante) }}" class="fw-bold small text-primary">
                        Ver perfil completo <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Proyecto -->
        <div class="col-lg-6">
            <div class="card card-bg-light-info h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-info-emphasis mb-3">Proyecto</h5>
                    <div class="mb-2">
                        <p class="text-muted small mb-0">Nombre</p>
                        <p class="fw-semibold">{{ $donacion->proyecto->nombre }}</p>
                    </div>
                    <div class="mb-2">
                        <p class="text-muted small mb-0">Carrera</p>
                        <p class="fw-medium">{{ $donacion->proyecto->carrera ?? 'No especificada' }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted small mb-0">Ubicación</p>
                        <p class="fw-medium">{{ $donacion->proyecto->ubicacion ?? 'No especificada' }}</p>
                    </div>
                    
                    <!-- Barra de Progreso Eliminada -->

                </div>
            </div>
        </div>
    </div>

    <!-- Fila de Detalles (Método y Timestamps) -->
    <div class="row g-4 mb-4">
        <!-- Método de Pago -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <p class="text-muted small mb-2">Método de Pago</p>
                    <span class="badge rounded-pill fs-6
                        {{ $donacion->metodo_pago == 'Efectivo' ? 'bg-success-light text-success' : '' }}
                        {{ $donacion->metodo_pago == 'Transferencia' ? 'bg-primary-light text-primary' : '' }}
                        {{ $donacion->metodo_pago == 'Paypal' ? 'bg-info-light text-info' : '' }}
                        {{ !in_array($donacion->metodo_pago, ['Efectivo', 'Transferencia', 'Paypal']) ? 'bg-secondary-light text-secondary' : '' }}">
                        @if($donacion->metodo_pago == 'Efectivo') 💵 @endif
                        @if($donacion->metodo_pago == 'Transferencia') 🏦 @endif
                        @if($donacion->metodo_pago == 'Paypal') 💳 @endif
                        {{ $donacion->metodo_pago }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Timestamps -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body p-4 d-flex justify-content-around">
                    <div>
                        <p class="text-muted small mb-1">Registrado el</p>
                        <p class="fw-medium mb-0">{{ $donacion->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Última actualización</p>
                        <p class="fw-medium mb-0">{{ $donacion->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Zona de Peligro -->
    <div class="card border-danger mt-4">
        <div class="card-header bg-danger-light text-danger fw-bold">
            Zona de Peligro
        </div>
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold">Eliminar esta donación</h6>
                <p class="text-muted small mb-0">Una vez eliminada, esta acción no se puede deshacer.</p>
            </div>
            
            <!-- Formulario de eliminación oculto -->
            <form action="{{ route('donaciones.destroy', $donacion) }}" method="POST" 
                  id="delete-form-{{ $donacion->id }}" class="d-none">
                @csrf
                @method('DELETE')
            </form>
            
            <!-- Botón que activa SweetAlert -->
            <button 
                type="button" 
                class="btn btn-danger"
                onclick="confirmarEliminacion({{ $donacion->id }})">
                <i class="bi bi-trash-fill"></i> Eliminar Donación
            </button>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Script de Confirmación de Eliminación -->
    <script>
        function confirmarEliminacion(id) {
            const style = getComputedStyle(document.body);
            const rojoMinerva = style.getPropertyValue('--rojo-minerva').trim();
            
            Swal.fire({
                title: "¿Eliminar esta donación?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: rojoMinerva,
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush