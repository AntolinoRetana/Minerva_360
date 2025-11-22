<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Minerva 360' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (Para los menús) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- TU CSS del Login (para las variables) -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- NUEVO CSS para el Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    @livewireStyles
</head>
<body>

    <!-- 1. Sidebar (Menú Lateral) -->
    <div class="sidebar">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('img/Letralogo.svg') }}" alt="Minerva Logo" width="35" height="35">
            <span>Minerva 360</span>
        </a>

        <!-- Enlaces de Navegación -->
        <ul class="nav flex-column">
            <li class="nav-item">
                <!-- La clase 'active' usa el Rojo Minerva -->
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-fill me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('proyectos.*') ? 'active' : '' }}" href="{{ route('proyectos.index') }}">
                    <i class="bi bi-briefcase-fill me-2"></i> Proyectos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('donantes.*') ? 'active' : '' }}" href="{{ route('donantes.index') }}">
                    <i class="bi bi-heart-fill me-2"></i> Donantes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('donaciones.*') ? 'active' : '' }}" href="{{ route('donaciones.index') }}">
                    <i class="bi bi-cash-stack me-2"></i> Donaciones
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-people-fill me-2"></i> Usuarios
                </a>
            </li>
        </ul>
    </div>

    <!-- 2. Contenido Principal (Incluye Top-Bar) -->
    <div class="main-content">
        <!-- Top-Bar (Barra Superior) -->
        <nav class="topbar">
            <!-- Botón para ocultar/mostrar sidebar en móviles (opcional) -->
            <button class="btn btn-link d-md-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <!-- Espaciador -->
            <div class="ms-auto"></div>

            <!-- Menú del Usuario (Dropdown) -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <!-- Formulario de Logout -->
                        <form action="{{ route('logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Área de Contenido de la Página -->
        <main class="content-area">
            @yield('content')
        </main>
    </div>


    <!-- Bootstrap JS (Bundle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/hamburguesa.js') }}"></script>

    @livewireScripts
    @stack('scripts')
</body>
</html>
