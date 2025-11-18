@extends('layouts.app')

@php($title = 'Donaciones')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2-institucional mb-0">Lista de Donaciones</h1>
        <div>
            <!-- Botón "Crear" con el color Rojo Minerva -->
            <a href="{{ route('donaciones.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Nueva Donación</span>
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
                            <th scope="col">Donante</th>
                            <th scope="col">Proyecto</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Método</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donaciones as $donacion)
                            <tr>
                                <td>{{ $donacion->id }}</td>
                                <td class="fw-medium">
                                    {{ $donacion->donante->nombre }} {{ $donacion->donante->apellido }}
                                </td>
                                <td>{{ $donacion->proyecto->nombre }}</td>
                                <td class="fw-bold text-success">
                                    ${{ number_format($donacion->monto, 2) }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') }}
                                </td>
                                <td>
                                    <!-- Badges de Bootstrap Light -->
                                    <span class="badge rounded-pill
                                        {{ $donacion->metodo_pago == 'Efectivo' ? 'bg-success-light text-success' : '' }}
                                        {{ $donacion->metodo_pago == 'Transferencia' ? 'bg-primary-light text-primary' : '' }}
                                        {{ $donacion->metodo_pago == 'Paypal' ? 'bg-info-light text-info' : '' }}
                                        {{ !in_array($donacion->metodo_pago, ['Efectivo', 'Transferencia', 'Paypal']) ? 'bg-secondary-light text-secondary' : '' }}">
                                        {{ $donacion->metodo_pago }}
                                    </span>
                                </td>
                                
                                <!-- Acciones con botones de Bootstrap -->
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('donaciones.show', $donacion) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="Ver">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('donaciones.edit', $donacion) }}" 
                                           class="btn btn-sm btn-outline-secondary" 
                                           title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        
                                        <!-- Formulario de eliminación oculto -->
                                        <form action="{{ route('donaciones.destroy', $donacion) }}" method="POST" 
                                              id="delete-form-{{ $donacion->id }}" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Botón que activa SweetAlert -->
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Eliminar"
                                            onclick="confirmarEliminacion({{ $donacion->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted p-4">
                                    No hay donaciones registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Paginación -->
        @if ($donaciones->hasPages())
            <div class="card-footer bg-white border-0">
                {{ $donaciones->links() }}
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
                title: "¿Eliminar esta donación?",
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
