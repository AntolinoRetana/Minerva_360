@extends('layouts.app')

@php($title = 'Editar Donante')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2-institucional mb-0">Editar Donante</h1>
        <div>
            <!-- Botón "Volver" con estilo secundario -->
            <a href="{{ route('donantes.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Volver al Listado</span>
            </a>
        </div>
    </div>

    <!-- Contenedor para el formulario -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4 p-md-5">
            
            <form action="{{ route('donantes.update', $donante) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label label-t">Nombre *</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $donante->nombre) }}" required
                               class="form-control @error('nombre') is-invalid @enderror">
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Apellido -->
                    <div class="col-md-6">
                        <label for="apellido" class="form-label label-t">Apellido *</label>
                        <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $donante->apellido) }}" required
                               class="form-control @error('apellido') is-invalid @enderror">
                        @error('apellido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="col-md-6">
                        <label for="correo" class="form-label label-t">Correo Electrónico *</label>
                        <input type="email" name="correo" id="correo" value="{{ old('correo', $donante->correo) }}" required
                               class="form-control @error('correo') is-invalid @enderror">
                        @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <label for="telefono" class="form-label label-t">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $donante->telefono) }}"
                               class="form-control @error('telefono') is-invalid @enderror">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Usuario -->
                    <div class="col-md-6">
                        <label for="usuario" class="form-label label-t">Usuario *</label>
                        <input type="text" name="usuario" id="usuario" value="{{ old('usuario', $donante->usuario) }}" required
                               class="form-control @error('usuario') is-invalid @enderror">
                        @error('usuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nueva Contraseña -->
                    <div class="col-md-6">
                        <label for="password" class="form-label label-t">Nueva Contraseña</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror">
                        <small class="form-text text-muted">Dejar en blanco para mantener la actual</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmar Nueva Contraseña -->
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label label-t">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control">
                    </div>
                </div>

                <!-- Botones de Acción -->
                <hr class="my-4">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('donantes.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Actualizar Donante
                    </button>
                </div>
                
            </form>
        </div>
    </div>

@endsection
