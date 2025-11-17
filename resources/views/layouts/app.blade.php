<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Minerva 360' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">Minerva 360°</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                    <a href="{{route('proyectos.index')}}"class="text-gray-700 hover:text-gray-900">Proyectos</a> 
                    <a href="{{ route('donantes.index') }}" class="text-indigo-600 font-semibold">Donantes</a>
                    <a href="{{ route('donaciones.index') }}" class="text-gray-700 hover:text-gray-900">Donaciones</a>
                    <!-- <span class="text-gray-700">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Cerrar sesión
                        </button>
                    </form> -->
                    <div x-data="{ open: false }" class="relative">
                        <button 
                            @click="open = !open" 
                            class="flex items-center space-x-2 px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md"
                        >
                            <span class="text-gray-800 font-semibold">{{ auth()->user()->name }}</span>
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Contenido del Dropdown -->
                        <div 
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10"
                        >
                            <a href="#" 
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                👤 Usuarios
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button 
                                    type="submit" 
                                    class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100"
                                >
                                    🔴 Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="p-6">
        @yield('content')
    </main>


    @livewireScripts
    @stack('scripts')
</body>
</html>
