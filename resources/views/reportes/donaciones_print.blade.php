<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Donaciones - Minerva 360</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 2px 0; font-size: 10px; color: #666; }
        
        .info-box {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        /* Estilos solo para pantalla (Botón de imprimir) */
        @media screen {
            .no-print {
                background: #333;
                color: white;
                text-align: center;
                padding: 10px;
                margin-bottom: 20px;
                cursor: pointer;
            }
            .no-print:hover { background: #555; }
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <!-- Botón solo visible en pantalla -->
    <div class="no-print" onclick="window.print()">
        🖨️ CLIC AQUÍ PARA IMPRIMIR O GUARDAR COMO PDF
    </div>

    <div class="header">
        <h1>Reporte General de Donaciones</h1>
        <p>Sistema Minerva 360 - Universidad de El Salvador</p>
        <p>Generado el: {{ $fechaReporte->format('d/m/Y H:i A') }}</p>
    </div>

    <div class="info-box">
        <strong>Resumen:</strong><br>
        Total de Transacciones: {{ $donaciones->count() }}<br>
        <strong>Total Recaudado: ${{ number_format($totalRecaudado, 2) }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Donante</th>
                <th>Proyecto</th>
                <th>Método</th>
                <th class="text-right">Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donaciones as $donacion)
            <tr>
                <td>#{{ $donacion->id }}</td>
                <td>{{ \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') }}</td>
                <td>{{ $donacion->donante->nombre }} {{ $donacion->donante->apellido }}</td>
                <td>{{ Str::limit($donacion->proyecto->nombre, 30) }}</td>
                <td>{{ $donacion->metodo_pago }}</td>
                <td class="text-right">${{ number_format($donacion->monto, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right font-bold">TOTAL GENERAL</td>
                <td class="text-right font-bold">${{ number_format($totalRecaudado, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Documento generado automáticamente por Minerva 360. Uso exclusivo administrativo.
    </div>

</body>
</html>