@extends('layouts.app')

@php($title = 'Detalle Donantes')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2-institucional mb-0">Información del Donante</h1>
        <div class="d-flex gap-2">
            <!-- Botón "Editar" con estilo secundario -->
            <a href="{{ route('donantes.edit', $donante) }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-pencil-fill"></i>
                <span>Editar</span>
            </a>
            <!-- Botón "Volver" -->
            <a href="{{ route('donantes.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Volver</span>
            </a>
        </div>
    </div>

    <!-- Fila de Estadísticas Principales -->
    <div class="row g-4 mb-4">
        <!-- Widget 1: Total Donado -->
        <div class="col-md-6">
            <div class="card stat-card-simple border-start-rojo">
                <p class="text-muted mb-1">Total Donado</p>
                <h2 class="fw-bold text-rojo mb-0">
                    ${{ number_format($totalDonado, 2) }}
                </h2>
            </div>
        </div>
        <!-- Widget 2: Total de Donaciones -->
        <div class="col-md-6">
            <div class="card stat-card-simple border-start-azul">
                <p class="text-muted mb-1">Total de Donaciones</p>
                <h2 class="fw-bold text-azul mb-0">
                    {{ $donante->donaciones->count() }}
                </h2>
            </div>
        </div>
    </div>


    <!-- Tarjeta de Detalles del Donante -->
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body p-4 p-md-5">
            <h5 class="card-title fw-bold mb-4">Detalles del Donante</h5>
            <div class="row g-4">
                <div class="col-md-6">
                    <p class="text-muted mb-1">Nombre Completo</p>
                    <h6 class="fw-bold">{{ $donante->nombre }} {{ $donante->apellido }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Correo Electrónico</p>
                    <h6 class="fw-medium">{{ $donante->correo }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Teléfono</p>
                    <h6 class="fw-medium">{{ $donante->telefono ?? 'No registrado' }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Usuario</p>
                    <h6 class="fw-medium">{{ $donante->usuario }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Fecha de Registro</p>
                    <h6 class="fw-medium">{{ $donante->created_at->format('d/m/Y H:i') }}</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta de Historial de Donaciones -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white border-0 p-4">
            <h5 class="fw-bold h2-institucional mb-0">Historial de Donaciones</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4 py-3">Fecha</th>
                            <th scope="col" class="px-4 py-3">Proyecto</th>
                            <th scope="col" class="px-4 py-3">Monto</th>
                            <th scope="col" class="px-4 py-3">Método</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donante->donaciones as $donacion)
                            <tr>
                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $donacion->proyecto->nombre }}
                                </td>
                                <td class="px-4 py-3 fw-bold text-success">
                                    ${{ number_format($donacion->monto, 2) }}
                                </td>
                                <td class="px-4 py-3">
                                    <!-- Badges de Bootstrap Light -->
                                    <span class="badge rounded-pill
                                        {{ $donacion->metodo_pago == 'Efectivo' ? 'bg-success-light text-success' : '' }}
                                        {{ $donacion->metodo_pago == 'Transferencia' ? 'bg-primary-light text-primary' : '' }}
                                        {{ $donacion->metodo_pago == 'Paypal' ? 'bg-info-light text-info' : '' }}
                                        {{ !in_array($donacion->metodo_pago, ['Efectivo', 'Transferencia', 'Paypal']) ? 'bg-secondary-light text-secondary' : '' }}">
                                        {{ $donacion->metodo_pago }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted p-4">
                                    Este donante aún no ha realizado donaciones.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
