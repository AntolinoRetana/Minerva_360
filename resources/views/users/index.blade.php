@extends('layouts.app')
@php($title = 'Gestión de Usuarios')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold h2-institucional mb-1">Gestión de Usuarios</h1>
            <p class="text-muted mb-0">Administra los usuarios del sistema</p>
        </div>
        <div>
            <!-- Botón "Nuevo Usuario" -->
            <a href="{{ route('users.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-person-plus-fill"></i>
                <span>Nuevo Usuario</span>
            </a>
        </div>
    </div>

    <!-- Contenedor Principal -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">

            <!-- Tabla de Usuarios -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4">Nombre</th>
                            <th scope="col" class="py-3">Email</th>
                            <th scope="col" class="py-3">Fecha de Registro</th>
                            <th scope="col" class="py-3 text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <!-- Avatar Circular con Iniciales -->
                                        <div class="avatar-circle me-3 bg-primary-light text-primary fw-bold d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px; rounded-circle; border-radius: 50%;">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            @if($user->id === auth()->id())
                                                <span class="badge bg-success-light text-success border border-success-subtle" style="font-size: 0.7rem;">
                                                    Tú
                                                </span>
                                            @else
                                                <span class="text-muted small">ID: {{ $user->id }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $user->email }}" class="text-decoration-none text-secondary">
                                        {{ $user->email }}
                                    </a>
                                </td>
                                <td class="text-muted">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('users.edit', $user) }}" 
                                           class="btn btn-sm btn-outline-secondary" 
                                           data-bs-toggle="tooltip" 
                                           title="Editar usuario">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        @if($user->id !== auth()->id())
                                            <!-- Botón Eliminar -->
                                            <button type="button"
                                                    onclick="confirmarEliminacionUsuario({{ $user->id }})"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Eliminar usuario">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>

                                            <!-- Formulario Oculto -->
                                            <form id="delete-form-{{ $user->id }}" 
                                                  action="{{ route('users.destroy', $user) }}" 
                                                  method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @else
                                            <!-- Espacio vacío para alinear si es el usuario actual -->
                                            <button class="btn btn-sm btn-outline-light disabled border-0" aria-disabled="true">
                                                <i class="bi bi-trash-fill text-white"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-people fs-1 d-block mb-3 opacity-50"></i>
                                    <p class="mb-0">No hay usuarios registrados en el sistema.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($users->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Inicializar tooltips de Bootstrap
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    function confirmarEliminacionUsuario(userId) {
        // Estilos de marca
        const style = getComputedStyle(document.body);
        const rojoMinerva = style.getPropertyValue('--rojo-minerva').trim();

        Swal.fire({
            title: '¿Eliminar usuario?',
            text: "Esta acción no se puede deshacer y el usuario perderá acceso.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: rojoMinerva,
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>
@endpush