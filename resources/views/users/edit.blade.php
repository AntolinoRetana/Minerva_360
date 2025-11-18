@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Editar Usuario</h2>
            <p class="text-gray-600 mt-2">Actualice la información del usuario</p>
        </div>

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Nombre completo *
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    required
                    value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Correo electrónico *
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t pt-4">
                <p class="text-sm font-medium text-gray-700 mb-4">
                    Cambiar contraseña (opcional)
                </p>
                <p class="text-xs text-gray-500 mb-4">
                    Deje estos campos en blanco si no desea cambiar la contraseña
                </p>

                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Nueva contraseña
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Mínimo 8 caracteres</p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirmar nueva contraseña
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('users.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium">
                    ← Cancelar
                </a>
                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-medium">
                    💾 Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
