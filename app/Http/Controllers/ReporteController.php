<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donacion;
use App\Models\Proyecto;
use Carbon\Carbon;

class ReporteController extends Controller
{
    // --- 1. EXPORTAR DONACIONES A EXCEL (CSV) ---
    public function exportarDonacionesCsv()
    {
        $fileName = 'donaciones_minerva_' . date('Y-m-d_H-i') . '.csv';
        $donaciones = Donacion::with('donante', 'proyecto')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID', 'Donante', 'Proyecto', 'Monto', 'Fecha', 'Metodo Pago', 'Registrado El');

        $callback = function() use($donaciones, $columns) {
            $file = fopen('php://output', 'w');
            
            // Agregar BOM para que Excel reconozca caracteres latinos (tildes, ñ)
            fputs($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns);

            foreach ($donaciones as $donacion) {
                $row['ID']  = $donacion->id;
                $row['Donante']    = $donacion->donante->nombre . ' ' . $donacion->donante->apellido;
                $row['Proyecto']    = $donacion->proyecto->nombre;
                $row['Monto']  = $donacion->monto;
                $row['Fecha']  = $donacion->fecha;
                $row['Metodo Pago']  = $donacion->metodo_pago;
                $row['Registrado El'] = $donacion->created_at;

                fputcsv($file, array($row['ID'], $row['Donante'], $row['Proyecto'], $row['Monto'], $row['Fecha'], $row['Metodo Pago'], $row['Registrado El']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // --- 2. VISTA DE IMPRESIÓN / PDF ---
    public function reporteDonacionesPrint()
    {
        $donaciones = Donacion::with('donante', 'proyecto')
                              ->orderBy('fecha', 'desc')
                              ->get();
                              
        $totalRecaudado = $donaciones->sum('monto');
        $fechaReporte = Carbon::now();

        return view('reportes.donaciones_print', compact('donaciones', 'totalRecaudado', 'fechaReporte'));
    }
}