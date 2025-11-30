@extends('layouts.app')

@php($title = 'Editar Donación')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2-institucional mb-0">Editar Donación</h1>
        <div>
            <!-- Botón "Volver" con estilo secundario -->
            <a href="{{ route('donaciones.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Volver al Listado</span>
            </a>
        </div>
    </div>

    <!-- Contenedor para el formulario -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4 p-md-5">
            
            <form action="{{ route('donaciones.update', $donacion) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Donante -->
                    <div class="col-md-6">
                        <label for="donante_id" class="form-label label-t">Donante *</label>
                        <select name="donante_id" id="donante_id" required
                                class="form-select @error('donante_id') is-invalid @enderror">
                            <option value="">Seleccione un donante</option>
                            @foreach($donantes as $donante)
                                <option value="{{ $donante->id }}" {{ old('donante_id', $donacion->donante_id) == $donante->id ? 'selected' : '' }}>
                                    {{ $donante->nombre }} {{ $donante->apellido }} - {{ $donante->correo }}
                                </option>
                            @endforeach
                        </select>
                        @error('donante_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Proyecto -->
                    <div class="col-md-6">
                        <label for="proyecto_id" class="form-label label-t">Proyecto *</label>
                        <select name="proyecto_id" id="proyecto_id" required
                                class="form-select @error('proyecto_id') is-invalid @enderror">
                            <option value="">Seleccione un proyecto</option>
                            @foreach($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}" {{ old('proyecto_id', $donacion->proyecto_id) == $proyecto->id ? 'selected' : '' }}>
                                    {{ $proyecto->nombre }} - Meta: ${{ number_format($proyecto->meta, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('proyecto_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Monto -->
                    <div class="col-md-6">
                        <label for="monto" class="form-label label-t">Monto *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="monto" id="monto" step="0.01" min="0.01" value="{{ old('monto', $donacion->monto) }}" required
                                   class="form-control @error('monto') is-invalid @enderror">
                            @error('monto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Fecha -->
                    <div class="col-md-6">
                        <label for="fecha" class="form-label label-t">Fecha *</label>
                        <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $donacion->fecha) }}" required
                               class="form-control @error('fecha') is-invalid @enderror">
                        @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Método de Pago -->
                    <div class="col-12">
                        <label class="form-label label-t mb-2">Método de Pago *</label>
                        <div class="row g-2">
                            <!-- Opción 1: Efectivo -->
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metodo_pago" id="metodo-efectivo" value="Efectivo" 
                                       {{ old('metodo_pago', $donacion->metodo_pago) == 'Efectivo' ? 'checked' : '' }} required>
                                <label class="btn btn-outline-secondary form-check-btn w-100" for="metodo-efectivo">
                                    <div class="fs-3">💵</div>
                                    <div class="fw-medium">Efectivo</div>
                                </label>
                            </div>
                            <!-- Opción 2: Transferencia -->
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metodo_pago" id="metodo-transferencia" value="Transferencia"
                                       {{ old('metodo_pago', $donacion->metodo_pago) == 'Transferencia' ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary form-check-btn w-100" for="metodo-transferencia">
                                    <div class="fs-3">🏦</div>
                                    <div class="fw-medium">Transferencia</div>
                                </label>
                            </div>
                            <!-- Opción 3: Paypal -->
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metodo_pago" id="metodo-paypal" value="Paypal"
                                       {{ old('metodo_pago', $donacion->metodo_pago) == 'Paypal' ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary form-check-btn w-100" for="metodo-paypal">
                                    <div class="fs-3">💳</div>
                                    <div class="fw-medium">PayPal</div>
                                </label>
                            </div>
                        </div>
                        @error('metodo_pago')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Botones de Acción -->
                <hr class="my-4">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('donaciones.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Actualizar Donación
                    </button>
                </div>
                
            </form>
        </div>
    </div>

@endsection
