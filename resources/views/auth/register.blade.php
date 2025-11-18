<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Minerva 360</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Font (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>

    <!-- Contenedor principal para centrar la tarjeta verticalmente -->
    <div class="container">
        <div class="row min-vh-100 d-flex align-items-center justify-content-center">
            <!-- Columna contenedora para limitar el ancho de la "card" -->
            <div class="col-12 col-lg-10 col-xl-9">
                
                <!--"Card" principal que contiene las dos columnas -->
                <div class="card shadow-lg border-0 login-card-container">
                    <div class="row g-0">
                        
                        <!-- Columna Izquierda (Panel Institucional) -->
                        <div class="col-md-6 col-lg-7 d-none d-md-flex login-panel-institucional">
                            <div class="p-5">
                                <img src="{{ asset('img/Logo.png') }}" height="200px" width="200px" alt="Logo Minerva" class="mb-4">
                                <h1 class="h2 text-white fw-bold mb-3">
                                    Únete a Minerva 360
                                </h1>
                                <p class="text-white-50">
                                    Crea tu cuenta para empezar a gestionar, enseñar y aprender de forma eficiente.
                                </p>
                                <div class="copyright-text-wrapper">
                                    © {{ date('Y') }} Minerva 360. Todos los derechos reservados.
                                </div>
                            </div>
                        </div>
    
                        <!-- Columna Derecha (Formulario) -->
                        <div class="col-md-6 col-lg-5 login-panel-form">
                
                            <div class="login-form-inner">
                                
                                <!-- Logo para vista móvil -->
                                <div class="text-center d-md-none mb-4">
                                    <img src="{{ asset('img/Miner.svg') }}" height="100px" width="100px" alt="Logo Minerva">
                                </div>
    
                                <div class="text-center text-md-start">
                                    <h2 class="h3 fw-bold h2-institucional mb-2">
                                        Crear cuenta
                                    </h2>
                                    <p class="text-muted small">
                                        ¿Ya tienes cuenta?
                                        <a href="{{ route('login') }}" class="fw-medium link-accion">
                                            Inicia sesión
                                        </a>
                                    </p>
                                </div>
    
                                <!-- Formulario de Registro -->
                                <form action="{{ route('register') }}" method="POST" class="mt-4">
                                    @csrf
    
                                    <!-- Campo Nombre -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label label-t">
                                            Nombre completo
                                        </label>
                                        <input id="name" name="name" type="text" required
                                               value="{{ old('name') }}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Campo Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label label-t">
                                            Correo electrónico
                                        </label>
                                        <input id="email" name="email" type="email" required
                                               value="{{ old('email') }}"
                                               class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <!-- Campo Contraseña -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label label-t">
                                            Contraseña
                                        </label>
                                        <input id="password" name="password" type="password" required
                                               class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Campo Confirmar Contraseña -->
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label label-t">
                                            Confirmar contraseña
                                        </label>
                                        <input id="password_confirmation" name="password_confirmation" type="password" required
                                               class="form-control">
                                    </div>
    
                                    <!-- Botón de Enviar -->
                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-primary w-100 py-2 fs-6 fw-medium">
                                            Registrarse
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>