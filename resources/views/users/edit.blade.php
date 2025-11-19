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
                            <input
                                id="name"
                                name="name"
                                type="text"
                                required
                                value="{{ old('name', $user->name) }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Ingrese el nombre completo">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label label-t fw-semibold">
                                Correo electrónico <span class="text-danger">*</span>
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                required
                                value="{{ old('email', $user->email) }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="correo@ejemplo.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Separador -->
                        <hr class="my-4">

                        <!-- Sección de Cambio de Contraseña -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-key me-2"></i>Cambiar contraseña (opcional)
                            </h5>
                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <small>Deje estos campos en blanco si no desea cambiar la contraseña</small>
                            </div>

                            <!-- Nueva Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label label-t fw-semibold">
                                    Nueva contraseña
                                </label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Mínimo 8 caracteres">
                                <small class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i>Mínimo 8 caracteres
                                </small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirmar Nueva Contraseña -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label label-t fw-semibold">
                                    Confirmar nueva contraseña
                                </label>
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    class="form-control"
                                    placeholder="Repita la nueva contraseña">
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
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
