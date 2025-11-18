@extends('layouts.app')
@php($title = 'Dashboard')
@section('content')

<!-- NUEVO: Layout de 2 columnas -->
<div class="row g-4">

    <!-- Columna Izquierda (Principal) -->
    <div class="col-lg-8">

        <!-- Fila de Widgets (La "Cosa Extra") -->
        <div class="row g-4 mb-4">
            
            <!-- Widget 1: Donaciones -->
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title text-muted mb-1">Total Donaciones</h5>
                            <h2 class="fw-bold mb-0">$12,500</h2>
                        </div>
                        <div class="stat-card-icon icon-rojo">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget 2: Proyectos -->
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title text-muted mb-1">Proyectos Activos</h5>
                            <h2 class="fw-bold mb-0">8</h2>
                        </div>
                        <div class="stat-card-icon icon-azul">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget 3: Donantes -->
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title text-muted mb-1">Nuevos Donantes</h5>
                            <h2 class="fw-bold mb-0">23</h2>
                        </div>
                        <div class="stat-card-icon icon-verde">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget 4: Usuarios -->
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title text-muted mb-1">Usuarios Totales</h5>
                            <h2 class="fw-bold mb-0">142</h2>
                        </div>
                        <div class="stat-card-icon icon-naranja">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Fin de la fila de widgets -->

        <!-- NUEVO: Gráfica de Proyectos -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4 p-md-5">
                <h5 class="fw-bold h2-institucional mb-3">Estado de Proyectos</h5>
                <!-- El canvas donde se dibujará la gráfica -->
                <canvas id="projectChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

    </div> <!-- Fin de la columna izquierda -->


    <!-- Columna Derecha (Lateral) -->
    <div class="col-lg-4">
        
        <!-- Tarjeta de Bienvenida (Movida aquí) -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                
                <h5 class="fw-bold h2-institucional mb-3">
                    ¡Bienvenido!
                </h5>

                <p class="text-muted small">
                    <strong class="text-brand-text">Usuario:</strong>
                    {{ auth()->user()->name }}
                </p>
                <p class="text-muted small mb-0">
                    <strong class="text-brand-text">Email:</strong>
                    {{ auth()->user()->email }}
                </p>
                
            </div>
        </div>

        <!-- NUEVO: Lista de Top Donantes -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <h5 class="fw-bold h2-institucional mb-3">Top Donantes</h5>
                <ul class="list-group list-group-flush donor-list">
                    <!-- Donante 1 (Ejemplo) -->
                    <li class="list-group-item donor-list-item">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle fs-4 me-3 text-muted"></i>
                            <div class="me-auto">
                                <h6 class="fw-bold mb-0">René Barrera</h6>
                                <small class="text-muted">Donó hace 2 días</small>
                            </div>
                            <span class="donor-amount">$2,500</span>
                        </div>
                    </li>
                    <!-- Donante 2 (Ejemplo) -->
                    <li class="list-group-item donor-list-item">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle fs-4 me-3 text-muted"></i>
                            <div class="me-auto">
                                <h6 class="fw-bold mb-0">Ana García</h6>
                                <small class="text-muted">Donó hace 1 semana</small>
                            </div>
                            <span class="donor-amount">$1,800</span>
                        </div>
                    </li>
                    <!-- Donante 3 (Ejemplo) -->
                    <li class="list-group-item donor-list-item">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle fs-4 me-3 text-muted"></i>
                            <div class="me-auto">
                                <h6 class="fw-bold mb-0">Carlos López</h6>
                                <small class="text-muted">Donó hace 3 semanas</small>
                            </div>
                            <span class="donor-amount">$1,200</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div> <!-- Fin de la columna derecha -->

</div> <!-- Fin de la fila principal -->

@endsection

@push('scripts')
<!-- NUEVO: Script para inicializar la gráfica -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('projectChart').getContext('2d');
        
        // Obtenemos los colores de nuestra paleta de CSS
        const style = getComputedStyle(document.body);
        const rojoMinerva = style.getPropertyValue('--rojo-minerva').trim();
        const azulOxford = style.getPropertyValue('--azul-oxford').trim();
        const verdeSuccess = '#198754'; // Verde para "completado"

        new Chart(ctx, {
            type: 'doughnut', // Tipo de gráfica
            data: {
                labels: ['Completados', 'En Progreso', 'Pendientes'],
                datasets: [{
                    data: [5, 2, 1], // Datos de ejemplo: 5 completados, 2 en progreso, 1 pendiente
                    backgroundColor: [
                        verdeSuccess,
                        azulOxford,
                        rojoMinerva
                    ],
                    borderColor: 'transparent',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom', // Mueve las etiquetas a la parte inferior
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                }
            }
        });
    });

    
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
    
@endpush+