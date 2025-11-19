@extends('layouts.app')

@php($title = 'Donantes')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2-institucional mb-0">Gestión de Donantes</h1>
        <div>
            <!-- Botón "Crear" con el color Rojo Minerva -->
            <a href="{{ route('donantes.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Nuevo Donante</span>
            </a>
        </div>
    </div>

    <!-- Contenedor para la tabla -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre Completo</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Donaciones</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donantes as $donante)
                            <tr>
                                <td>{{ $donante->id }}</td>
                                <td class="fw-medium">{{ $donante->nombre }} {{ $donante->apellido }}</td>
                                <td>{{ $donante->correo }}</td>
                                <td>{{ $donante->telefono ?? 'N/A' }}</td>
                                <td>{{ $donante->usuario }}</td>
                                <td>
                                    <span class="badge bg-primary-light text-primary">
                                        {{ $donante->donaciones_count }}
                                    </span>
                                </td>
                                
                                <!-- Acciones con botones de Bootstrap -->
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('donantes.show', $donante) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="Ver">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('donantes.edit', $donante) }}" 
                                           class="btn btn-sm btn-outline-secondary" 
                                           title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        
                                        <!-- Formulario de eliminación oculto -->
                                        <form action="{{ route('donantes.destroy', $donante) }}" method="POST" 
                                              id="delete-form-{{ $donante->id }}" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Botón que activa SweetAlert -->
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Eliminar"
                                            onclick="confirmarEliminacion({{ $donante->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted p-4">
                                    No hay donantes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Paginación -->
        @if ($donantes->hasPages())
            <div class="card-footer bg-white border-0">
                {{ $donantes->links() }}
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <!-- Script de Confirmación de Eliminación (con colores de marca) -->
    <script>
        function confirmarEliminacion(id) {
            // Obtenemos los colores de la paleta desde el CSS
            const style = getComputedStyle(document.body);
            const rojoMinerva = style.getPropertyValue('--rojo-minerva').trim();
            
            Swal.fire({
                title: "¿Eliminar este donante?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: rojoMinerva,
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si confirma, envía el formulario de eliminación oculto
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush