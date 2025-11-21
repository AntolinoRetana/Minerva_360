@extends('layouts.app')

@section('content')

    <!-- Cabecera -->
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-bold h2-institucional mb-1">Mi Perfil</h1>
            <p class="text-muted mb-0">Información de tu cuenta</p>
        </div>
        <div>
            <!-- Botón Principal para ir a Editar -->
            <a href="{{ route('profile.edit') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square"></i>
                <span>Editar Perfil</span>
            </a>
        </div>
    </div>

    <div class="row g-4">
        
        <!-- Tarjeta Principal: Identidad -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3 text-center p-4 h-100">
                <div class="card-body">
                    
                    <!-- Foto de Perfil (Grande y Solo Lectura) -->
                    <div class="d-inline-block mb-3 position-relative">
                        <div class="rounded-circle overflow-hidden border border-4 border-white shadow" 
                             style="width: 150px; height: 150px;">
                            @if($user->profile_photo_path)
                                <img src="{{ env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/' . $user->profile_photo_path }}" 
                                class="w-100 h-100 object-fit-cover" 
                                 alt="{{ $user->name }}">
                            @else
                                <div class="w-100 h-100 bg-primary-light text-primary fw-bold d-flex align-items-center justify-content-center display-1">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <h3 class="fw-bold text-dark mb-1">{{ $user->name }}</h3>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    
                    <span class="badge bg-success-light text-success px-3 py-2 rounded-pill fs-6">
                        <i class="bi bi-check-circle-fill me-1"></i> Activo
                    </span>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Detalles -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="fw-bold h2-institucional mb-0">Detalles de la Cuenta</h5>
                </div>
                <div class="card-body p-4">
                    
                    <div class="row g-4">
                        <!-- Nombre -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Nombre Completo</small>
                                <div class="fw-medium text-dark fs-5">{{ $user->name }}</div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Correo Electrónico</small>
                                <div class="fw-medium text-dark fs-5">{{ $user->email }}</div>
                            </div>
                        </div>

                        <!-- Rol (Estático por ahora) -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Rol del Sistema</small>
                                <div class="fw-medium text-dark fs-5">
                                    <i class="bi bi-shield-lock me-2 text-primary"></i>Administrador
                                </div>
                            </div>
                        </div>

                        <!-- Fecha de Registro -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Miembro Desde</small>
                                <div class="fw-medium text-dark fs-5">
                                    {{ $user->created_at->format('d F, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-25">

                    <!-- Sección de Seguridad (Informativa) -->
                    <div>
                        <h6 class="fw-bold text-dark mb-3">Seguridad</h6>
                        <div class="d-flex align-items-center justify-content-between p-3 border rounded-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning-light text-warning rounded p-2 me-3">
                                    <i class="bi bi-key-fill fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Contraseña</div>
                                    <small class="text-muted">************</small>
                                </div>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary">
                                Cambiar
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection