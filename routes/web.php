<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Livewire\Proyectos;
use App\Livewire\Proyectos\CrearProyecto;
use App\Livewire\Proyectos\EditarProyecto;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonanteController;
use App\Http\Controllers\DonacionController;
use App\Http\Controllers\ImagenesProyectoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProfileController;

// Rutas públicas
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rutas protegidas
    Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // En routes/web.php, dentro del grupo de rutas protegidas (middleware auth)
    Route::get('/dashboard/actualizar', [DashboardController::class, 'getDatosActualizados'])
    ->name('dashboard.actualizar');

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);

    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');

    // Editar Perfil (Formulario)
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');

    // Acciones de actualización
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    });


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

       // Ver galería
    Route::get('/proyectos/{id}/imagenes',
        [ImagenesProyectoController::class, 'porProyecto']
    )->name('imagenes-proyecto.por-proyecto');

    // Subir imagen
    Route::get('/imagenes-proyecto/create',
        [ImagenesProyectoController::class, 'create']
    )->name('imagenes-proyecto.create');

    Route::post('/imagenes-proyecto/store',
        [ImagenesProyectoController::class, 'store']
    )->name('imagenes-proyecto.store');

    // Eliminar imagen
    Route::delete('/imagenes-proyecto/{id}/eliminar',
        [ImagenesProyectoController::class, 'eliminarImagen']
    )->name('imagenes-proyecto.eliminar');



// Redirigir raíz según autenticación
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::get('/reportes/donaciones/csv', [ReporteController::class, 'exportarDonacionesCsv'])->name('reportes.donaciones.csv');

Route::get('/reportes/donaciones/print', [ReporteController::class, 'reporteDonacionesPrint'])->name('reportes.donaciones.print');
