@extends('layouts.app')

@php($title = 'Donaciones')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold h2-institucional mb-1">Lista de Donaciones</h1>
            <p class="text-muted mb-0">Registro de todas las donaciones recibidas</p>
        </div>
        
        <div class="d-flex gap-2">
            
            <!-- Grupo de Botones de Reportes -->
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-download"></i>
                    <span>Reportes</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('reportes.donaciones.csv') }}">
                            <i class="bi bi-file-earmark-spreadsheet text-success"></i> Exportar a Excel (CSV)
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('reportes.donaciones.print') }}" target="_blank">
                            <i class="bi bi-printer text-secondary"></i> Imprimir / PDF
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Botón "Nueva Donación" -->
            <a href="{{ route('donaciones.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Nueva Donación</span>
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
                            <th scope="col" class="py-3">Donante</th>
                            <th scope="col" class="py-3">Proyecto</th>
                            <th scope="col" class="py-3">Monto</th>
                            <th scope="col" class="py-3">Fecha</th>
                            <th scope="col" class="py-3 text-center">Método</th>
                            <th scope="col" class="py-3 text-center pe-4" style="min-width: 300px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donaciones as $donacion)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#{{ $donacion->id }}</td>
                                <td class="fw-medium">
                                    {{ $donacion->donante->nombre }} {{ $donacion->donante->apellido }}
                                </td>
                                <td class="text-muted text-truncate" style="max-width: 200px;" title="{{ $donacion->proyecto->nombre }}">
                                    {{ $donacion->proyecto->nombre }}
                                </td>
                                <td class="fw-bold text-success">
                                    ${{ number_format($donacion->monto, 2) }}
                                </td>
                                <td class="text-muted">
                                    {{ \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="text-center">
                                    <!-- Badges Estilizados -->
                                    <span class="badge rounded-pill px-3 py-2 fw-normal
                                        {{ $donacion->metodo_pago == 'Efectivo' ? 'bg-success-light text-success' : '' }}
                                        {{ $donacion->metodo_pago == 'Transferencia' ? 'bg-primary-light text-primary' : '' }}
                                        {{ $donacion->metodo_pago == 'Paypal' ? 'bg-info-light text-info' : '' }}
                                        {{ !in_array($donacion->metodo_pago, ['Efectivo', 'Transferencia', 'Paypal']) ? 'bg-secondary-light text-secondary' : '' }}">
                                        
                                        @if($donacion->metodo_pago == 'Efectivo') <i class="bi bi-cash me-1"></i> @endif
                                        @if($donacion->metodo_pago == 'Transferencia') <i class="bi bi-bank me-1"></i> @endif
                                        @if($donacion->metodo_pago == 'Paypal') <i class="bi bi-paypal me-1"></i> @endif
                                        {{ $donacion->metodo_pago }}
                                    </span>
                                </td>
                                
                                <!-- Acciones con Botones Estilizados -->
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        
                                        <!-- Botón Ver (Cian/Info) -->
                                        <a href="{{ route('donaciones.show', $donacion) }}" 
                                           class="btn btn-sm btn-outline-info d-flex align-items-center gap-1 fw-medium px-2"
                                           title="Ver detalles">
                                            <i class="bi bi-eye-fill"></i>
                                            <span>Ver</span>
                                        </a>

                                        <!-- Botón Editar (Gris/Secundario) -->
                                        <a href="{{ route('donaciones.edit', $donacion) }}" 
                                           class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1 fw-medium px-2"
                                           title="Editar donación">
                                            <i class="bi bi-pencil-fill"></i>
                                            <span>Editar</span>
                                        </a>
                                        
                                        <!-- Botón Eliminar (Rojo/Danger) -->
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1 fw-medium px-2" 
                                            onclick="confirmarEliminacion({{ $donacion->id }})"
                                            title="Eliminar donación">
                                            <i class="bi bi-trash-fill"></i>
                                            <span>Eliminar</span>
                                        </button>

                                        <!-- Formulario de eliminación oculto -->
                                        <form action="{{ route('donaciones.destroy', $donacion) }}" method="POST" 
                                              id="delete-form-{{ $donacion->id }}" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted p-5">
                                    <i class="bi bi-piggy-bank fs-1 d-block mb-3 opacity-50"></i>
                                    <p class="mb-0">No hay donaciones registradas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Paginación -->
        @if ($donaciones->hasPages())
            <div class="card-footer bg-white border-0 pt-0 pb-4">
                <div class="d-flex justify-content-center">
                    {{ $donaciones->links() }}
                </div>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
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
                title: "¿Eliminar esta donación?",
                text: "Esta acción no se puede deshacer y afectará al total recaudado del proyecto.",
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