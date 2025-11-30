@extends('layouts.app')
@php($title = 'Dashboard')

@section('content')

<!-- Indicador de actualización automática -->
<div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
    <i class="bi bi-info-circle-fill me-2"></i>
    <strong>Dashboard en Tiempo Real</strong> - Los datos se actualizan automáticamente cada 30 segundos
    <span id="ultimaActualizacion" class="ms-2 badge bg-primary"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

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
                    <h3 class="mb-0 text-truncate" id="totalDonaciones" title="${{ number_format($totalDonaciones, 2) }}">
                        ${{ number_format($totalDonaciones, 2) }}
                    </h3>
                    <small class="text-success mt-1 d-block">
                        <i class="bi bi-arrow-up"></i>
                        <span id="donacionesHoy">{{ $donacionesHoy }}</span> hoy
                    </small>
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
                    <h3 class="mb-0" id="proyectosActivos">{{ $proyectosActivos }}</h3>
                    <small class="text-muted mt-1 d-block">
                        de <span id="totalProyectos">{{ $totalProyectos }}</span> totales
                    </small>
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
                    <h3 class="mb-0" id="nuevosDonantes">{{ $nuevosDonantes }}</h3>
                    <small class="text-muted mt-1 d-block">
                        Promedio: $<span id="promediodonacion">{{ number_format($promediodonacion, 2) }}</span>
                    </small>
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
                    <h3 class="mb-0" id="usuariosTotales">{{ $usuariosTotales }}</h3>
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
                    <button class="btn btn-sm btn-outline-secondary" onclick="actualizarDashboard()">
                        <i class="bi bi-arrow-clockwise me-1"></i> Actualizar
                    </button>
                </div>

                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. FILA INFERIOR -->
<div class="row g-4 mb-4">

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
                <ul class="list-group list-group-flush" id="topDonantesList">
                    @forelse($topDonantes as $donante)
                        <li class="list-group-item border-0 px-4 py-3 d-flex align-items-center">
                            <div class="rounded-circle bg-light text-primary fw-bold d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width: 40px; height: 40px; font-size: 1.1rem;">
                                {{ substr($donante->nombre, 0, 1) }}
                            </div>
                            <div class="flex-grow-1 min-width-0">
                                <h6 class="fw-bold text-dark mb-0 text-truncate" title="{{ $donante->nombre }} {{ $donante->apellido }}">
                                    {{ $donante->nombre }} {{ $donante->apellido }}
                                </h6>
                                <small class="text-muted text-truncate d-block">
                                    {{ $donante->donaciones_count ?? 0 }} donaciones
                                </small>
                            </div>
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

<!-- 4. DONACIONES RECIENTES -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold h2-institucional mb-0">
                    <i class="bi bi-clock-history me-2"></i>Donaciones Recientes
                </h5>
                <a href="{{ route('donaciones.index') }}" class="text-decoration-none small fw-medium link-accion">Ver todas</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="donacionesRecientesTable">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Donante</th>
                                <th class="px-4 py-3">Proyecto</th>
                                <th class="px-4 py-3">Monto</th>
                                <th class="px-4 py-3">Hace</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donacionesRecientes as $donacion)
                                <tr>
                                    <td class="px-4 py-3">
                                        <strong>{{ $donacion->donante->nombre }} {{ $donacion->donante->apellido }}</strong>
                                    </td>
                                    <td class="px-4 py-3">{{ $donacion->proyecto->nombre }}</td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-success">${{ number_format($donacion->monto, 2) }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-muted">
                                        {{ $donacion->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        No hay donaciones recientes
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let trendChartInstance = null;
    let projectChartInstance = null;

    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar gráficas
        initCharts();

        // Actualizar cada 30 segundos
        setInterval(actualizarDashboard, 30000);

        // Mostrar última actualización
        actualizarTimestamp();
    });

    function initCharts() {
        // --- 1. Gráfica de Dona ---
        const ctxDoughnut = document.getElementById('projectChart');
        if (ctxDoughnut) {
            const chartData = @json($doughnutChartData ?? []);
            const totalProyectos = chartData.reduce((a, b) => a + b, 0);
            const finalData = totalProyectos > 0 ? chartData : [1];

            projectChartInstance = new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Completados', 'Activos', 'Pendientes'],
                    datasets: [{
                        data: finalData,
                        backgroundColor: totalProyectos > 0 ? ['#198754', '#1B263B', '#bd2d27'] : ['#e9ecef'],
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

        // --- 2. Gráfica de Líneas ---
        const ctxLine = document.getElementById('trendChart');
        if (ctxLine) {
            const lineData = @json($lineChartData ?? []);
            const lineLabels = @json($mesesLabels ?? []);

            const gradient = ctxLine.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(189, 45, 39, 0.2)');
            gradient.addColorStop(1, 'rgba(189, 45, 39, 0.0)');

            trendChartInstance = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: lineLabels,
                    datasets: [{
                        label: 'Recaudado ($)',
                        data: lineData,
                        borderColor: '#bd2d27',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#bd2d27',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Recaudado: $' + context.parsed.y.toLocaleString();
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
                    }
                }
            });
        }
    }

    function actualizarDashboard() {
        fetch('{{ route("dashboard.actualizar") }}')
            .then(response => response.json())
            .then(data => {
                // Actualizar widgets
                document.getElementById('totalDonaciones').textContent = '$' + data.totalDonaciones;
                document.getElementById('proyectosActivos').textContent = data.proyectosActivos;
                document.getElementById('nuevosDonantes').textContent = data.nuevosDonantes;
                document.getElementById('usuariosTotales').textContent = data.usuariosTotales;
                document.getElementById('donacionesHoy').textContent = data.donacionesHoy;
                document.getElementById('promediodonacion').textContent = data.promediodonacion;
                document.getElementById('totalProyectos').textContent = data.totalProyectos;

                // Actualizar gráfica de líneas
                if (trendChartInstance) {
                    trendChartInstance.data.datasets[0].data = data.lineChartData;
                    trendChartInstance.update();
                }

                // Actualizar gráfica de dona
                if (projectChartInstance) {
                    projectChartInstance.data.datasets[0].data = data.doughnutChartData;
                    projectChartInstance.update();
                }

                // Actualizar top donantes
                actualizarTopDonantes(data.topDonantes);

                // Actualizar donaciones recientes
                actualizarDonacionesRecientes(data.donacionesRecientes);

                // Actualizar timestamp
                actualizarTimestamp(data.timestamp);
            })
            .catch(error => console.error('Error actualizando dashboard:', error));
    }

    function actualizarTopDonantes(donantes) {
        const lista = document.getElementById('topDonantesList');
        if (!donantes || donantes.length === 0) {
            lista.innerHTML = '<li class="list-group-item border-0 p-4 text-center text-muted"><p class="mb-0">Aún no hay donantes registrados.</p></li>';
            return;
        }

        lista.innerHTML = donantes.map(d => `
            <li class="list-group-item border-0 px-4 py-3 d-flex align-items-center">
                <div class="rounded-circle bg-light text-primary fw-bold d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                     style="width: 40px; height: 40px; font-size: 1.1rem;">
                    ${d.inicial}
                </div>
                <div class="flex-grow-1 min-width-0">
                    <h6 class="fw-bold text-dark mb-0 text-truncate">${d.nombre} ${d.apellido}</h6>
                    <small class="text-muted">${d.cantidad} donaciones</small>
                </div>
                <div class="text-end ms-3 flex-shrink-0">
                    <span class="fw-bold text-danger">$${d.total}</span>
                </div>
            </li>
        `).join('');
    }

    function actualizarDonacionesRecientes(donaciones) {
        const tbody = document.querySelector('#donacionesRecientesTable tbody');
        if (!donaciones || donaciones.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-muted">No hay donaciones recientes</td></tr>';
            return;
        }

        tbody.innerHTML = donaciones.map(d => `
            <tr>
                <td class="px-4 py-3"><strong>${d.donante}</strong></td>
                <td class="px-4 py-3">${d.proyecto}</td>
                <td class="px-4 py-3"><span class="badge bg-success">$${d.monto}</span></td>
                <td class="px-4 py-3 text-muted">${d.fecha}</td>
            </tr>
        `).join('');
    }

    function actualizarTimestamp(time) {
        const badge = document.getElementById('ultimaActualizacion');
        badge.textContent = time ? `Actualizado: ${time}` : `Actualizado: ${new Date().toLocaleTimeString()}`;
    }
</script>
@endpush
