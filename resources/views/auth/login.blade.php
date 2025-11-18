<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Minerva 360</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>

    <div class="container">
        <div class="row min-vh-100 d-flex align-items-center justify-content-center">
            <!-- Columna contenedora para limitar el ancho de la "card" -->
            <div class="col-12 col-lg-10 col-xl-9">

                <!-- La "Card" principal que contiene las dos columnas -->
                <div class="card shadow-lg border-0 login-card-container">
                    <div class="row g-0">

                        <!-- Columna Izquierda (Panel Institucional) -->
                        <div class="col-md-6 col-lg-7 d-none d-md-flex login-panel-institucional">
                            <div class="p-5">
                                <img src="{{ asset('img/Logo.png') }}" height="150px" width="150px" alt="Logo Minerva" class="mb-4">
                                <h1 class="h2 text-white fw-bold mb-3">
                                    Bienvenido a Minerva 360
                                </h1>
                                <p class="text-white-75">
                                    Tu plataforma de gestión académica todo en uno. Administra, enseña y aprende de forma eficiente.
                                </p>
                                <div class="copyright-text-wrapper">
                                    © {{ date('Y') }} Minerva 360. Todos los derechos reservados.
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div class="col-md-6 col-lg-5 login-panel-form">
                            <!-- Wrapper interno para centrar y limitar el ancho del formulario -->
                            <div class="login-form-inner">

                                <!-- Logo para vista móvil -->
                                <div class="text-center d-md-none mb-4">
                                    <img src="{{ asset('img/Logo.png') }}" height="100px" width="100px" alt="Logo Minerva">
                                </div>

                                <div class="text-center text-md-start">
                                    <h2 class="h3 fw-bold h2-institucional mb-2">
                                        Iniciar sesión
                                    </h2>
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success mt-4">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Formulario -->
                                <form action="{{ route('login') }}" method="POST" class="mt-4">
                                    @csrf

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

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input id="remember" name="remember" type="checkbox" class="form-check-input">
                                            <label for="remember" class="form-check-label label-t">
                                                Recordarme
                                            </label>
                                        </div>
                                        <a href="#" class="fw-medium link-accion small">¿Olvidaste tu contraseña?</a>
                                    </div>

                                    <!-- Botón de Enviar (Estilo de marca) -->
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary w-100 py-2 fs-6 fw-medium">
                                            Iniciar sesión
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
