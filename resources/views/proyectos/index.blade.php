@extends('layouts.app')

@php($title = 'Proyectos')
@section('content')

    <!-- Cabecera de la Página -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2-institucional mb-0">Gestión de Proyectos</h1>
        <div>
            <!-- Botón "Crear" con el color Rojo Minerva -->
            <a href="{{ route('proyectos.crear') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Crear Proyecto</span>
            </a>
        </div>
    </div>

    <!-- Contenedor para la tabla de Livewire -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <!-- Aquí se renderizará tu tabla de Livewire -->
            <livewire:proyectos-index />
        </div>
    </div>

@endsection

@push('scripts')

    <!-- Script de Confirmación de Eliminación (con colores de marca) -->
    <script>
        function confirmarEliminacion(id) {
            // Obtenemos los colores de la paleta desde el CSS
            const style = getComputedStyle(document.body);
            const rojoMinerva = style.getPropertyValue('--rojo-minerva').trim();
            const azulOxford = style.getPropertyValue('--azul-oxford').trim();

            Swal.fire({
                title: "¿Eliminar este proyecto?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: rojoMinerva, // Color de marca
                cancelButtonColor: "#6c757d",    // Color gris estándar
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarProyecto', { id: id });
                }
            });
        }

    </script>
    
    @if(session('success')) 
        <script> 
            document.addEventListener("DOMContentLoaded", () => { 
                Swal.fire({ 
                    toast: true,
                    position: 'top-end', 
                    icon: 'success', 
                    title: "{{ session('success') }}", 
                    showConfirmButton: false, 
                    timer: 3000, 
                    timerProgressBar: true
                 }); 
            }); 

        </script> 
    @endif
@endpush