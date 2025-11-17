<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Donante</title>
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
                    <a href="{{ route('donantes.index') }}" class="text-indigo-600 font-semibold">Donantes</a>
                    <a href="{{ route('donaciones.index') }}" class="text-gray-700 hover:text-gray-900">Donaciones</a>
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
                <h2 class="text-2xl font-bold text-gray-800">Información del Donante</h2>
                <div class="space-x-2">
                    <a href="{{ route('donantes.edit', $donante) }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium">
                        Editar
                    </a>
                    <a href="{{ route('donantes.index') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-medium">
                        Volver
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Nombre Completo</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $donante->nombre }} {{ $donante->apellido }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Correo Electrónico</p>
                        <p class="mt-1 text-lg text-gray-900">{{ $donante->correo }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Teléfono</p>
                        <p class="mt-1 text-lg text-gray-900">{{ $donante->telefono ?? 'No registrado' }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Usuario</p>
                        <p class="mt-1 text-lg text-gray-900">{{ $donante->usuario }}</p>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg border-2 border-green-200">
                        <p class="text-sm font-medium text-green-700">Total Donado</p>
                        <p class="mt-1 text-2xl font-bold text-green-600">${{ number_format($totalDonado, 2) }}</p>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg border-2 border-blue-200">
                        <p class="text-sm font-medium text-blue-700">Total de Donaciones</p>
                        <p class="mt-1 text-2xl font-bold text-blue-600">{{ $donante->donaciones->count() }}</p>
                    </div>
                </div>

                <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Fecha de Registro</p>
                    <p class="mt-1 text-lg text-gray-900">{{ $donante->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Historial de Donaciones -->
        <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-800">Historial de Donaciones</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proyecto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Monto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Método</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($donante->donaciones as $donacion)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $donacion->proyecto->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                    ${{ number_format($donacion->monto, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $donacion->metodo_pago == 'Efectivo' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $donacion->metodo_pago == 'Transferencia' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $donacion->metodo_pago == 'Paypal' ? 'bg-purple-100 text-purple-800' : '' }}">
                                        {{ $donacion->metodo_pago }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Este donante aún no ha realizado donaciones
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
