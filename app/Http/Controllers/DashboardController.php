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
        // Obtenemos todas las donaciones del año actual
        $donacionesAnuales = Donacion::whereYear('fecha', Carbon::now()->year)->get();

        // Agrupamos por mes usando colecciones (funciona en cualquier DB)
        $donacionesPorMes = $donacionesAnuales->groupBy(function($d) {
            return Carbon::parse($d->fecha)->format('n'); // 1 para Enero, 2 para Febrero...
        })->map(function($row) {
            return $row->sum('monto');
        });

        // Rellenamos con 0 los meses que no tienen donaciones
        $lineChartData = [];
        $mesesLabels = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $lineChartData[] = $donacionesPorMes[$i] ?? 0;
            // Creamos las etiquetas de los meses en español
            $mesesLabels[] = Carbon::create()->month($i)->locale('es')->monthName; // 'enero', 'febrero'...
        }
        // Capitalizar primera letra de los meses
        $mesesLabels = array_map('ucfirst', $mesesLabels);


        // --- 4. TOP DONANTES ---
        $topDonantes = Donante::withSum('donaciones', 'monto')
                              ->orderByDesc('donaciones_sum_monto')
                              ->take(4) // Mostramos 4 para llenar mejor el espacio
                              ->get();

        return view('dashboard', compact(
            'totalDonaciones',
            'proyectosActivos',
            'nuevosDonantes',
            'usuariosTotales',
            'doughnutChartData',
            'lineChartData',     // Datos para la línea
            'mesesLabels',       // Etiquetas para la línea (Enero, Febrero...)
            'topDonantes'
        ));
    }
}