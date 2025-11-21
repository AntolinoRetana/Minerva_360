@extends('layouts.app')

@section('content')

    <!-- Cabecera -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold h2-institucional mb-1">Editar Perfil</h1>
            <p class="text-muted mb-0">Actualiza tu información personal</p>
        </div>
        <div>
            <!-- Botón Volver a VER -->
            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Volver al Perfil</span>
            </a>
        </div>
    </div>

    <div class="row g-4">
        
        <!-- Columna Izquierda: Foto y Datos Básicos -->
        <div class="col-lg-4">
            
            <!-- Formulario Principal (Foto y Datos) -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="infoForm">
                @csrf
                @method('PATCH')

                <!-- Tarjeta de Foto de Perfil -->
                <div class="card shadow-sm border-0 rounded-3 mb-4 h-100">
                    <div class="card-body p-4 text-center">
                        <h6 class="fw-bold text-start mb-4 text-muted text-uppercase small">Foto de Perfil</h6>
                        
                        <!-- Contenedor de la Imagen -->
                        <div class="position-relative d-inline-block mb-3 group-action">
                            <div class="rounded-circle overflow-hidden border border-4 border-light shadow-sm" 
                                 style="width: 150px; height: 150px;">
                                
                                <!-- Lógica para mostrar la imagen actual -->
                                @if($user->profile_photo_path)
                                    <img id="preview-image" 
                                         src="{{ env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/' . $user->profile_photo_path }}" 
                                         class="w-100 h-100 object-fit-cover" 
                                         alt="{{ $user->name }}">
                                @else
                                    <div id="preview-avatar" 
                                         class="w-100 h-100 bg-primary-light text-primary fw-bold d-flex align-items-center justify-content-center display-1">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <!-- Imagen oculta para JS -->
                                    <img id="preview-image" class="w-100 h-100 object-fit-cover d-none" src="">
                                @endif
                            </div>
                            
                            <!-- Input Oculto -->
                            <input type="file" name="photo" id="photo" class="d-none" accept="image/*" onchange="previewPhoto(this)">
                            
                            <!-- Botón Flotante de Cámara -->
                            <button type="button" 
                                    onclick="document.getElementById('photo').click()"
                                    class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle shadow border-2 border-white"
                                    style="width: 40px; height: 40px;"
                                    data-bs-toggle="tooltip" title="Subir nueva foto">
                                <i class="bi bi-camera-fill fs-6"></i>
                            </button>
                        </div>
                        
                        <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-0 text-truncate">{{ $user->email }}</p>
                    </div>
                </div>
            
            <!-- Cierre del form principal abajo -->
        </div>

        <!-- Columna Derecha: Formularios -->
        <div class="col-lg-8">
            
            <!-- 1. Tarjeta de Información Básica -->
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="fw-bold h2-institucional mb-0">Información Básica</h5>
                </div>
                <div class="card-body p-4">
                    
                    <!-- (Continuación del Formulario Principal) -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label label-t fw-medium">Nombre Completo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                       class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label label-t fw-medium">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                       class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" form="infoForm" class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="bi bi-check-lg"></i>
                            <span>Guardar Información</span>
                        </button>
                    </div>
                    </form> <!-- Fin del form principal -->
                </div>
            </div>

            <!-- 2. Tarjeta de Contraseña (Formulario Separado) -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="fw-bold h2-institucional mb-0">Cambiar Contraseña</h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="alert alert-light border-start border-4 border-warning mb-4 p-3 bg-warning-subtle text-warning-emphasis">
                            <div class="d-flex">
                                <i class="bi bi-shield-exclamation fs-4 me-3"></i>
                                <div>
                                    <strong>Zona de Seguridad</strong>
                                    <p class="mb-0 small">
                                        Al cambiar tu contraseña, se cerrará la sesión en otros dispositivos.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label label-t fw-medium">Contraseña Actual</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-key"></i></span>
                                <input type="password" name="current_password" 
                                       class="form-control border-start-0 @error('current_password') is-invalid @enderror"
                                       placeholder="Confirmar contraseña actual">
                                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label label-t fw-medium">Nueva Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" 
                                           class="form-control border-start-0 @error('password') is-invalid @enderror"
                                           placeholder="Mínimo 8 caracteres">
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label label-t fw-medium">Confirmar Nueva</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-check-circle"></i></span>
                                    <input type="password" name="password_confirmation" 
                                           class="form-control border-start-0"
                                           placeholder="Repite la nueva contraseña">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top">
                            <button type="submit" class="btn btn-outline-dark d-flex align-items-center gap-2">
                                <i class="bi bi-shield-lock"></i>
                                <span>Actualizar Contraseña</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var avatarDiv = document.getElementById('preview-avatar');
                if(avatarDiv) avatarDiv.classList.add('d-none');
                
                var img = document.getElementById('preview-image');
                img.src = e.target.result;
                img.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush