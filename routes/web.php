<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Livewire\Proyectos;
use App\Livewire\Proyectos\CrearProyecto;
use App\Livewire\Proyectos\EditarProyecto;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonanteController;
use App\Http\Controllers\DonacionController;

// Rutas públicas
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas de Proyectos
    Route::get('/proyectos', function () {
        return view('proyectos.index');
    })->name('proyectos.index');

    Route::get('/proyectos/crear', function () {
        return view('proyectos.crear');
    })->name('proyectos.crear');

    Route::get('/proyectos/{proyecto}/editar', function (Proyecto $proyecto) {
        return view('proyectos.editar', compact('proyecto'));
    })->name('proyectos.editar');

    // Rutas de Donantes
    Route::resource('donantes', DonanteController::class);

    // Rutas de Donaciones
    Route::resource('donaciones', DonacionController::class)->parameters([
        'donaciones' => 'donacion'
    ]);

    // Rutas de Usuarios (CRUD completo)
    Route::resource('users', UserController::class);
});

// Redirigir raíz según autenticación
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});
