@extends('layouts.app')
@php($title = 'Crear Usuario')

@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold h2-institucional mb-1">Crear Nuevo Usuario</h1>
            <p class="text-muted mb-0">Registrar un nuevo administrador o usuario en el sistema</p>
        </div>
        <div>
            <!-- Botón "Volver" -->
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Volver al Listado</span>
            </a>
        </div>
    </div>

    <!-- Contenedor del Formulario -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4 p-md-5">
            
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    
                    <!-- Nombre Completo -->
                    <div class="col-md-6">
                        <label for="name" class="form-label label-t fw-medium">Nombre completo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror" 
                                   placeholder="Ej. Juan Pérez"
                                   required>
                            @error('name')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="col-md-6">
                        <label for="email" class="form-label label-t fw-medium">Correo electrónico <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                   placeholder="correo@ejemplo.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Separador -->
                    <div class="col-12">
                        <hr class="text-muted opacity-25">
                        <h6 class="fw-bold text-muted mb-0 text-uppercase small ls-1">Seguridad</h6>
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-6">
                        <label for="password" class="form-label label-t fw-medium">Contraseña <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" 
                                   placeholder="Mínimo 8 caracteres"
                                   required>
                            @error('password')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text text-muted small">
                            <i class="bi bi-info-circle me-1"></i>Debe tener al menos 8 caracteres.
                        </div>
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label label-t fw-medium">Confirmar contraseña <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Repita la contraseña"
                                   required>
                        </div>
                    </div>

                </div>

                <!-- Botones de Acción -->
                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="bi bi-save"></i>
                        <span>Guardar Usuario</span>
                    </button>
                </div>
                
            </form>
        </div>
    </div>

@endsection

