<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Donación</title>
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

    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Registrar Nueva Donación</h2>
                <a href="{{ route('donaciones.index') }}" class="text-gray-600 hover:text-gray-900">
                    ← Volver
                </a>
            </div>

            <form action="{{ route('donaciones.store') }}" method="POST" class="p-6">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="donante_id" class="block text-sm font-medium text-gray-700">Donante *</label>
                        <select name="donante_id" id="donante_id" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('donante_id') border-red-500 @enderror">
                            <option value="">Seleccione un donante</option>
                            @foreach($donantes as $donante)
                                <option value="{{ $donante->id }}" {{ old('donante_id') == $donante->id ? 'selected' : '' }}>
                                    {{ $donante->nombre }} {{ $donante->apellido }} - {{ $donante->correo }}
                                </option>
                            @endforeach
                        </select>
                        @error('donante_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            ¿No está el donante? <a href="{{ route('donantes.create') }}" class="text-indigo-600 hover:text-indigo-800">Crear nuevo donante</a>
                        </p>
                    </div>

                    <div>
                        <label for="proyecto_id" class="block text-sm font-medium text-gray-700">Proyecto *</label>
                        <select name="proyecto_id" id="proyecto_id" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('proyecto_id') border-red-500 @enderror">
                            <option value="">Seleccione un proyecto</option>
                            @foreach($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}" {{ old('proyecto_id') == $proyecto->id ? 'selected' : '' }}>
                                    {{ $proyecto->nombre }} - Meta: ${{ number_format($proyecto->meta, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('proyecto_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="monto" class="block text-sm font-medium text-gray-700">Monto *</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="monto" id="monto" step="0.01" min="0.01" value="{{ old('monto') }}" required
                                       class="pl-7 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('monto') border-red-500 @enderror">
                            </div>
                            @error('monto')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha *</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('fecha') border-red-500 @enderror">
                            @error('fecha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Método de Pago *</label>
                        <div class="grid grid-cols-3 gap-4">
                            <label class="relative flex items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-indigo-500 hover:bg-indigo-50">
                                <input type="radio" name="metodo_pago" value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'checked' : '' }} class="sr-only" required>
                                <div class="text-center">
                                    <div class="text-2xl mb-1">💵</div>
                                    <div class="text-sm font-medium text-gray-900">Efectivo</div>
                                </div>
                            </label>

                            <label class="relative flex items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-indigo-500 hover:bg-indigo-50">
                                <input type="radio" name="metodo_pago" value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'checked' : '' }} class="sr-only">
                                <div class="text-center">
                                    <div class="text-2xl mb-1">🏦</div>
                                    <div class="text-sm font-medium text-gray-900">Transferencia</div>
                                </div>
                            </label>

                            <label class="relative flex items-center justify-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-indigo-500 hover:bg-indigo-50">
                                <input type="radio" name="metodo_pago" value="Paypal" {{ old('metodo_pago') == 'Paypal' ? 'checked' : '' }} class="sr-only">
                                <div class="text-center">
                                    <div class="text-2xl mb-1">💳</div>
                                    <div class="text-sm font-medium text-gray-900">PayPal</div>
                                </div>
                            </label>
                        </div>
                        @error('metodo_pago')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('donaciones.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Registrar Donación
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Efecto visual para radio buttons
        document.querySelectorAll('input[name="metodo_pago"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('input[name="metodo_pago"]').forEach(r => {
                    r.parentElement.classList.remove('border-indigo-500', 'bg-indigo-50');
                });
                if (this.checked) {
                    this.parentElement.classList.add('border-indigo-500', 'bg-indigo-50');
                }
            });
        });

        // Pre-seleccionar el método si ya estaba seleccionado
        const selectedMethod = document.querySelector('input[name="metodo_pago"]:checked');
        if (selectedMethod) {
            selectedMethod.parentElement.classList.add('border-indigo-500', 'bg-indigo-50');
        }
    </script>
</body>
</html>
