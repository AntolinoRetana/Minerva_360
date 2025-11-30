<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Donante;
use App\Models\Donacion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. WIDGETS (Tarjetas Superiores) ---
        $totalDonaciones = Donacion::sum('monto');
        $proyectosActivos = Proyecto::where('estado', 'Activo')->count();

        // Nuevos donantes este mes
        $nuevosDonantes = Donante::whereMonth('created_at', Carbon::now()->month)
                                 ->whereYear('created_at', Carbon::now()->year)
                                 ->count();

        $usuariosTotales = User::count();

        // --- 2. GRÁFICA DE DONA (Estado de Proyectos) ---
        $proyectosPorEstado = Proyecto::select('estado', DB::raw('count(*) as total'))
                                      ->groupBy('estado')
                                      ->pluck('total', 'estado');

        $doughnutChartData = [
            $proyectosPorEstado['Completado'] ?? 0,
            $proyectosPorEstado['Activo'] ?? 0,
            $proyectosPorEstado['Pendiente'] ?? 0,
        ];

        // --- 3. GRÁFICA DE LÍNEAS (Tendencia de Donaciones por Mes) ---
        $donacionesAnuales = Donacion::whereYear('fecha', Carbon::now()->year)->get();

        $donacionesPorMes = $donacionesAnuales->groupBy(function($d) {
            return Carbon::parse($d->fecha)->format('n');
        })->map(function($row) {
            return $row->sum('monto');
        });

        $lineChartData = [];
        $mesesLabels = [];

        for ($i = 1; $i <= 12; $i++) {
            $lineChartData[] = $donacionesPorMes[$i] ?? 0;
            $mesesLabels[] = Carbon::create()->month($i)->locale('es')->monthName;
        }

        $mesesLabels = array_map('ucfirst', $mesesLabels);

        // --- 4. TOP DONANTES ---
        $topDonantes = Donante::withSum('donaciones', 'monto')
                              ->withCount('donaciones')
                              ->has('donaciones') // SOLO donantes que tienen donaciones
                              ->orderByDesc('donaciones_sum_monto')
                              ->take(4)
                              ->get();

        // --- 5. DONACIONES RECIENTES (Nueva sección) ---
        $donacionesRecientes = Donacion::with(['donante', 'proyecto'])
                                       ->orderBy('created_at', 'desc')
                                       ->take(5)
                                       ->get();

        // --- 6. ESTADÍSTICAS ADICIONALES ---
        $promediodonacion = Donacion::avg('monto');
        $donacionesHoy = Donacion::whereDate('fecha', Carbon::today())->count();
        $totalProyectos = Proyecto::count();

        return view('dashboard', compact(
            'totalDonaciones',
            'proyectosActivos',
            'nuevosDonantes',
            'usuariosTotales',
            'doughnutChartData',
            'lineChartData',
            'mesesLabels',
            'topDonantes',
            'donacionesRecientes',
            'promediodonacion',
            'donacionesHoy',
            'totalProyectos'
        ));
    }

    // API para actualizar datos en tiempo real
    public function getDatosActualizados()
    {
        return response()->json([
            'totalDonaciones' => number_format(Donacion::sum('monto'), 2),
            'proyectosActivos' => Proyecto::where('estado', 'Activo')->count(),
            'nuevosDonantes' => Donante::whereMonth('created_at', Carbon::now()->month)
                                       ->whereYear('created_at', Carbon::now()->year)
                                       ->count(),
            'usuariosTotales' => User::count(),
            'donacionesHoy' => Donacion::whereDate('fecha', Carbon::today())->count(),
            'promediodonacion' => number_format(Donacion::avg('monto'), 2),

            // Top donantes actualizado
            'topDonantes' => Donante::withSum('donaciones', 'monto')
                                    ->withCount('donaciones')
                                    ->has('donaciones') // SOLO con donaciones
                                    ->orderByDesc('donaciones_sum_monto')
                                    ->take(4)
                                    ->get()
                                    ->map(function($donante) {
                                        return [
                                            'nombre' => $donante->nombre,
                                            'apellido' => $donante->apellido,
                                            'inicial' => substr($donante->nombre, 0, 1),
                                            'total' => number_format($donante->donaciones_sum_monto, 2),
                                            'cantidad' => $donante->donaciones_count
                                        ];
                                    }),

            // Donaciones recientes
            'donacionesRecientes' => Donacion::with(['donante', 'proyecto'])
                                             ->orderBy('created_at', 'desc')
                                             ->take(5)
                                             ->get()
                                             ->map(function($d) {
                                                 return [
                                                     'donante' => $d->donante->nombre . ' ' . $d->donante->apellido,
                                                     'proyecto' => $d->proyecto->nombre,
                                                     'monto' => number_format($d->monto, 2),
                                                     'fecha' => Carbon::parse($d->created_at)->diffForHumans()
                                                 ];
                                             }),

            // Datos para gráficas
            'lineChartData' => $this->getLineChartData(),
            'doughnutChartData' => $this->getDoughnutChartData(),

            'timestamp' => now()->format('H:i:s')
        ]);
    }

    private function getLineChartData()
    {
        $donacionesAnuales = Donacion::whereYear('fecha', Carbon::now()->year)->get();

        $donacionesPorMes = $donacionesAnuales->groupBy(function($d) {
            return Carbon::parse($d->fecha)->format('n');
        })->map(function($row) {
            return $row->sum('monto');
        });

        $lineChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $lineChartData[] = $donacionesPorMes[$i] ?? 0;
        }

        return $lineChartData;
    }

    private function getDoughnutChartData()
    {
        $proyectosPorEstado = Proyecto::select('estado', DB::raw('count(*) as total'))
                                      ->groupBy('estado')
                                      ->pluck('total', 'estado');

        return [
            $proyectosPorEstado['Completado'] ?? 0,
            $proyectosPorEstado['Activo'] ?? 0,
            $proyectosPorEstado['Pendiente'] ?? 0,
        ];
    }
}
