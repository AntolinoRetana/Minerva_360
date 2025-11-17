<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Donación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">Sistema de Donaciones</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                    <a href="{{ route('donantes.index') }}" class="text-gray-700 hover:text-gray-900">Donantes</a>
                    <a href="{{ route('donaciones.index') }}" class="text-indigo-600 font-semibold">Donaciones</a>
                    <span class="text-gray-700">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Detalles de la Donación</h2>
                <div class="space-x-2">
                    <a href="{{ route('donaciones.edit', $donacion) }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium">
                        Editar
                    </a>
                    <a href="{{ route('donaciones.index') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-medium">
                        Volver
                    </a>
                </div>
            </div>

            <div class="p-6">
                <!-- Información de la Donación -->
                <div class="bg-gradient-to-r from-green-50 to-green-100 border-2 border-green-200 rounded-lg p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-700">Monto Donado</p>
                            <p class="mt-2 text-4xl font-bold text-green-600">${{ number_format($donacion->monto, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-green-700">Fecha de Donación</p>
                            <p class="mt-2 text-2xl font-semibold text-green-600">{{ \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información del Donante -->
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <h3 class="text-sm font-medium text-blue-700 mb-3 uppercase">Donante</h3>
                        <div class="space-y-2">
                            <div>
                                <p class="text-xs text-blue-600">Nombre</p>
                                <p class="text-lg font-semibold text-blue-900">{{ $donacion->donante->nombre }} {{ $donacion->donante->apellido }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-blue-600">Correo</p>
                                <p class="text-sm text-blue-800">{{ $donacion->donante->correo }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-blue-600">Teléfono</p>
                                <p class="text-sm text-blue-800">{{ $donacion->donante->telefono ?? 'No registrado' }}</p>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('donantes.show', $donacion->donante) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                    Ver perfil completo →
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Proyecto -->
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                        <h3 class="text-sm font-medium text-purple-700 mb-3 uppercase">Proyecto</h3>
                        <div class="space-y-2">
                            <div>
                                <p class="text-xs text-purple-600">Nombre</p>
                                <p class="text-lg font-semibold text-purple-900">{{ $donacion->proyecto->nombre }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-purple-600">Carrera</p>
                                <p class="text-sm text-purple-800">{{ $donacion->proyecto->carrera ?? 'No especificada' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-purple-600">Ubicación</p>
                                <p class="text-sm text-purple-800">{{ $donacion->proyecto->ubicacion ?? 'No especificada' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-purple-600">Progreso</p>
                                <div class="mt-1">
                                    <div class="w-full bg-purple-200 rounded-full h-2">
                                        <div class="bg-purple-600 h-2 rounded-full" style="width: {{ ($donacion->proyecto->progreso / $donacion->proyecto->meta) * 100 }}%"></div>
                                    </div>
                                    <p class="text-xs text-purple-700 mt-1">
                                        ${{ number_format($donacion->proyecto->progreso, 2) }} / ${{ number_format($donacion->proyecto->meta, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Método de Pago -->
                <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500 mb-2">Método de Pago</p>
                    <span class="px-4 py-2 inline-flex text-lg leading-5 font-semibold rounded-full
                        {{ $donacion->metodo_pago == 'Efectivo' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $donacion->metodo_pago == 'Transferencia' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $donacion->metodo_pago == 'Paypal' ? 'bg-purple-100 text-purple-800' : '' }}">
                        @if($donacion->metodo_pago == 'Efectivo') 💵 @endif
                        @if($donacion->metodo_pago == 'Transferencia') 🏦 @endif
                        @if($donacion->metodo_pago == 'Paypal') 💳 @endif
                        {{ $donacion->metodo_pago }}
                    </span>
                </div>

                <!-- Información de Registro -->
                <div class="mt-6 grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Registrado el</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $donacion->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Última actualización</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $donacion->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de Eliminar -->
        <div class="mt-6 text-center">
            <form action="{{ route('donaciones.destroy', $donacion) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta donación? Esta acción no se puede deshacer.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-medium">
                    🗑️ Eliminar Donación
                </button>
            </form>
        </div>
    </div>
</body>
</html>
