@extends('layouts.app')
@php($title = 'Gestión de Usuarios')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4 p-md-5">

            <!-- Encabezado -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold h2-institucional mb-1">Gestión de Usuarios</h2>
                    <p class="text-muted small mb-0">Administra los usuarios del sistema</p>
                </div>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Nuevo Usuario
                </a>
            </div>

            <!-- Alertas -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-muted fw-semibold">ID</th>
                            <th scope="col" class="text-muted fw-semibold">Nombre</th>
                            <th scope="col" class="text-muted fw-semibold">Email</th>
                            <th scope="col" class="text-muted fw-semibold">Fecha de Registro</th>
                            <th scope="col" class="text-muted fw-semibold text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="fw-medium">{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-circle fs-4 me-2 text-muted"></i>
                                        <div>
                                            <span class="fw-semibold">{{ $user->name }}</span>
                                            @if($user->id === auth()->id())
                                                <span class="badge bg-primary ms-2">Tú</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $user->email }}</td>
                                <td class="text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="btn btn-sm btn-outline-primary me-2"
                                       data-bs-toggle="tooltip"
                                       title="Editar usuario">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <button
                                            onclick="confirmarEliminacion({{ $user->id }})"
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="tooltip"
                                            title="Eliminar usuario">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $user->id }}"
                                              action="{{ route('users.destroy', $user) }}"
                                              method="POST"
                                              class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    <p class="mb-0">No hay usuarios registrados</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmarEliminacion(userId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
<<<<<<< HEAD
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
=======
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
>>>>>>> origin/Desarrollo
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + userId).submit();
        }
    });
}
<<<<<<< HEAD
=======

// Inicializar tooltips de Bootstrap
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
>>>>>>> origin/Desarrollo
</script>
@endpush
@endsection
