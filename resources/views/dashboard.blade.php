<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">Mi Aplicación</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">¡Bienvenido, {{ auth()->user()->name }}!</h2>
                <p class="text-gray-600">Has iniciado sesión correctamente.</p>

                <div class="mt-6 space-y-2">
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Miembro desde:</strong> {{ auth()->user()->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
    <a href="{{ route('donantes.index') }}" class="block p-6 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100">
        <h3 class="text-lg font-semibold text-indigo-900">Gestión de Donantes</h3>
        <p class="text-indigo-700 mt-2">Ver, crear y editar donantes</p>
    </a>

    <a href="{{ route('donaciones.index') }}" class="block p-6 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100">
        <h3 class="text-lg font-semibold text-green-900">Gestión de Donaciones</h3>
        <p class="text-green-700 mt-2">Registrar y administrar donaciones</p>
    </a>
</div>
</body>
</html>
