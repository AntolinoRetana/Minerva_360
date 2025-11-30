@extends('layouts.app')
@php($title = 'Editar Usuario')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4 p-md-5">

                    <!-- Encabezado -->
                    <div class="mb-4">
                        <h2 class="fw-bold h2-institucional mb-2">Editar Usuario</h2>
                        <p class="text-muted">Actualice la información del usuario</p>
                    </div>

                    <!-- Formulario -->
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label label-t fw-semibold">
                                Nombre completo <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    required
                                    value="{{ old('name', $user->name) }}"
                                    class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                    placeholder="Ingrese el nombre completo">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label label-t fw-semibold">
                                Correo electrónico <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    value="{{ old('email', $user->email) }}"
                                    class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                    placeholder="correo@ejemplo.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Separador -->
                        <hr class="my-4 text-muted opacity-25">

                        <!-- Sección de Cambio de Contraseña -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-brand-text">
                                <i class="bi bi-shield-lock me-2"></i>Cambiar contraseña (opcional)
                            </h5>
                            <div class="alert alert-info d-flex align-items-center border-0 bg-info-subtle text-info-emphasis" role="alert">
                                <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                                <small>Deje estos campos en blanco si no desea cambiar la contraseña actual.</small>
                            </div>

                            <!-- Nueva Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label label-t fw-semibold">
                                    Nueva contraseña
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-key"></i>
                                    </span>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                        placeholder="Mínimo 8 caracteres">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text text-muted small">
                                    Mínimo 8 caracteres.
                                </div>
                            </div>

                            <!-- Confirmar Nueva Contraseña -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label label-t fw-semibold">
                                    Confirmar nueva contraseña
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-check-circle"></i>
                                    </span>
                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        class="form-control border-start-0 ps-0"
                                        placeholder="Repita la nueva contraseña">
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-2"></i>Actualizar Usuario
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection