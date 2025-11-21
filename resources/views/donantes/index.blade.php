@extends('layouts.app')

@php($title = 'Donantes')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold h2-institucional mb-1">Gestión de Donantes</h1>
            <p class="text-muted mb-0">Administra la información de los donantes</p>
        </div>
        <div>
            <!-- Botón "Nuevo Donante" -->
            <a href="{{ route('donantes.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Nuevo Donante</span>
            </a>
        </div>
    </div>

    <!-- Contenedor Principal -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4">ID</th>
                            <th scope="col" class="py-3">Nombre Completo</th>
                            <th scope="col" class="py-3">Correo</th>
                            <th scope="col" class="py-3">Teléfono</th>
                            <th scope="col" class="py-3">Usuario</th>
                            <th scope="col" class="py-3 text-center">Donaciones</th>
                            <th scope="col" class="py-3 text-center pe-4" style="min-width: 300px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donantes as $donante)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#{{ $donante->id }}</td>
                                <td class="fw-medium">{{ $donante->nombre }} {{ $donante->apellido }}</td>
                                <td>
                                    <a href="mailto:{{ $donante->correo }}" class="text-decoration-none text-secondary">
                                        {{ $donante->correo }}
                                    </a>
                                </td>
                                <td class="text-muted">{{ $donante->telefono ?? 'N/A' }}</td>
                                <td class="text-muted">{{ $donante->usuario }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary-light text-primary rounded-pill px-3">
                                        {{ $donante->donaciones_count }}
                                    </span>
                                </td>
                                
                                <!-- Acciones con Botones Estilizados -->
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        
                                        <!-- Botón Ver (Cian/Info) -->
                                        <a href="{{ route('donantes.show', $donante) }}" 
                                           class="btn btn-sm btn-outline-info d-flex align-items-center gap-1 fw-medium px-2" 
                                           title="Ver detalles">
                                            <i class="bi bi-eye-fill"></i>
                                            <span>Ver</span>
                                        </a>

                                        <!-- Botón Editar (Gris/Secundario) -->
                                        <a href="{{ route('donantes.edit', $donante) }}" 
                                           class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1 fw-medium px-2" 
                                           title="Editar donante">
                                            <i class="bi bi-pencil-fill"></i>
                                            <span>Editar</span>
                                        </a>
                                        
                                        <!-- Botón Eliminar (Rojo/Danger) -->
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1 fw-medium px-2" 
                                            onclick="confirmarEliminacion({{ $donante->id }})"
                                            title="Eliminar donante">
                                            <i class="bi bi-trash-fill"></i>
                                            <span>Eliminar</span>
                                        </button>

                                        <!-- Formulario de eliminación oculto -->
                                        <form action="{{ route('donantes.destroy', $donante) }}" method="POST" 
                                              id="delete-form-{{ $donante->id }}" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted p-5">
                                    <i class="bi bi-people fs-1 d-block mb-3 opacity-50"></i>
                                    <p class="mb-0">No hay donantes registrados en el sistema.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($donantes->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $donantes->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection

@push('scripts')
    <!-- Script de Confirmación de Eliminación -->
    <script>
        // Inicializar tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        function confirmarEliminacion(id) {
            const style = getComputedStyle(document.body);
            const rojoMinerva = style.getPropertyValue('--rojo-minerva').trim();
            
            Swal.fire({
                title: "¿Eliminar este donante?",
                text: "Esta acción no se puede deshacer. Se eliminará el historial de donaciones asociado.",
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