@extends('layouts.app')
@php($title = 'Dashboard')
@section('content')

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
    
@endsection
