@extends('layouts.app')
@php($title = 'Dashboard')

@section('content')

<!-- 1. FILA DE WIDGETS (Ancho Completo) -->
<div class="row g-3 mb-4">
    <!-- Widget 1: Donaciones -->
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="stat-text-content">
                    <h6 class="text-muted text-uppercase fw-bold text-truncate" title="Total Donaciones">
                        Total Donaciones
                    </h6>
                    <h3 class="mb-0 text-truncate" title="${{ number_format($totalDonaciones, 2) }}">
                        ${{ number_format($totalDonaciones, 2) }}
                    </h3>
                </div>
                <div class="stat-card-icon icon-rojo shadow-sm">
                    <i class="bi bi-heart-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Widget 2: Proyectos -->
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="stat-text-content">
                    <h6 class="text-muted text-uppercase fw-bold text-truncate" title="Proyectos Activos">
                        Proyectos Activos
                    </h6>
                    <h3 class="mb-0">{{ $proyectosActivos }}</h3>
                </div>
                <div class="stat-card-icon icon-azul shadow-sm">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Widget 3: Donantes -->
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="stat-text-content">
                    <h6 class="text-muted text-uppercase fw-bold text-truncate" title="Nuevos Donantes (Mes)">
                        Nuevos (Mes)
                    </h6>
                    <h3 class="mb-0">{{ $nuevosDonantes }}</h3>
                </div>
                <div class="stat-card-icon icon-verde shadow-sm">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Widget 4: Usuarios -->
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="stat-text-content">
                    <h6 class="text-muted text-uppercase fw-bold text-truncate" title="Usuarios Totales">
                        Usuarios Totales
                    </h6>
                    <h3 class="mb-0">{{ $usuariosTotales }}</h3>
                </div>
                <div class="stat-card-icon icon-naranja shadow-sm">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div> 


<!-- 2. GRÁFICA DE TENDENCIAS (Nueva - Ancho Completo o casi) -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold h2-institucional mb-0">
                        <i class="bi bi-graph-up-arrow me-2"></i>Recaudación Mensual ({{ date('Y') }})
                    </h5>
                    <!-- Botón simulado de exportación -->
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-download me-1"></i> Reporte
                    </button>
                </div>
                
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 3. FILA INFERIOR (Gráfica Dona y Top Donantes) -->
<div class="row g-4">
    
    <!-- Gráfica de Dona -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-3 h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold h2-institucional mb-4">Estado de Proyectos</h5>
                <div class="chart-container">
                    <canvas id="projectChart"></canvas>
                </div>
            </div>
        </div>
    </div> 

    <!-- Top Donantes -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-3 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold h2-institucional mb-0">Top Donantes</h5>
                <a href="{{ route('donantes.index') }}" class="text-decoration-none small fw-medium link-accion">Ver todos</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($topDonantes as $donante)
                        <li class="list-group-item border-0 px-4 py-3 d-flex align-items-center">
                            <!-- Avatar -->
                            <div class="rounded-circle bg-light text-primary fw-bold d-flex align-items-center justify-content-center me-3 flex-shrink-0" 
                                 style="width: 40px; height: 40px; font-size: 1.1rem;">
                                {{ substr($donante->nombre, 0, 1) }}
                            </div>
                            <!-- Info -->
                            <div class="flex-grow-1 min-width-0">
                                <h6 class="fw-bold text-dark mb-0 text-truncate" title="{{ $donante->nombre }} {{ $donante->apellido }}">
                                    {{ $donante->nombre }} {{ $donante->apellido }}
                                </h6>
                                <small class="text-muted text-truncate d-block">
                                    {{ $donante->donaciones_count ?? 0 }} donaciones
                                </small>
                            </div>
                            <!-- Monto -->
                            <div class="text-end ms-3 flex-shrink-0">
                                <span class="fw-bold text-danger d-block">
                                    ${{ number_format($donante->donaciones_sum_monto, 0) }}
                                </span>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item border-0 p-4 text-center text-muted">
                            <p class="mb-0">Aún no hay donantes registrados.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // --- 1. Gráfica de Dona (Estado Proyectos) ---
        const ctxDoughnut = document.getElementById('projectChart');
        if (ctxDoughnut) {
            const chartData = @json($doughnutChartData ?? []);
            const totalProyectos = chartData.reduce((a, b) => a + b, 0);
            const finalData = totalProyectos > 0 ? chartData : [1];
            
            const rojoMinerva = '#bd2d27';
            const azulOxford = '#1B263B';
            const verdeSuccess = '#198754'; 
            const grisVacio = '#e9ecef';

            new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Completados', 'Activos', 'Pendientes'],
                    datasets: [{
                        data: finalData,
                        backgroundColor: totalProyectos > 0 ? [verdeSuccess, azulOxford, rojoMinerva] : [grisVacio],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%', 
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { usePointStyle: true, padding: 20, font: { size: 12, family: "'Poppins', sans-serif" } }
                        },
                        tooltip: { enabled: totalProyectos > 0 }
                    }
                }
            });
        }

        // --- 2. GRÁFICA DE LÍNEAS (Tendencias de Donaciones) ---
        const ctxLine = document.getElementById('trendChart');
        if (ctxLine) {
            const lineData = @json($lineChartData ?? []);
            const lineLabels = @json($mesesLabels ?? []);
            
            // Gradiente para el fondo de la línea (Efecto moderno)
            const gradient = ctxLine.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(189, 45, 39, 0.2)'); // Rojo Minerva transparente
            gradient.addColorStop(1, 'rgba(189, 45, 39, 0.0)');

            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: lineLabels, // Enero, Febrero, etc.
                    datasets: [{
                        label: 'Recaudado ($)',
                        data: lineData,
                        borderColor: '#bd2d27', // Rojo Minerva
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#bd2d27',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // Curvatura suave (spline)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }, // Ocultamos leyenda para limpieza
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) { label += ': '; }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [5, 5], color: '#f0f0f0' },
                            ticks: {
                                callback: function(value) { return '$' + value; },
                                font: { family: "'Poppins', sans-serif" }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: "'Poppins', sans-serif" } }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        }
    });
</script>
@endpush