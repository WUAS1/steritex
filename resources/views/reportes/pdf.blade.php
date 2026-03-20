<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Fallas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .filters {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte de Fallas - Steritex</h2>
        <p>Generado el {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="filters">
        <h4>Filtros aplicados:</h4>
        <p><strong>Desde:</strong> {{ $filters['fecha_inicio'] ?? 'No especificado' }}</p>
        <p><strong>Hasta:</strong> {{ $filters['fecha_fin'] ?? 'No especificado' }}</p>
        <p><strong>Tipo:</strong> {{ $filters['tipo'] ?? 'Todos' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Motivo</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->tipo }}</td>
                    <td>{{ $r->cantidad }}</td>
                    <td>{{ $r->motivo }}</td>
                    <td>{{ $r->fecha->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px; text-align: right;">
        <p><strong>Total de registros:</strong> {{ $registros->count() }}</p>
    </div>
</body>
</html>