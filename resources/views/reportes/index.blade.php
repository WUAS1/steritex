@extends('layouts.app')

@section('title', 'Reportes - Steritex')

@section('content')
<div class="py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="bi bi-bar-chart"></i> Reportes</h2>
            <p class="text-muted mb-0">Resumen filtrable por rango de fechas</p>
        </div>
        <div>
            <a href="{{ route('reportes.export', ['fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin]) }}" class="btn btn-success">
                <i class="bi bi-download"></i> Exportar CSV
            </a>
            <a href="{{ route('reportes.export.excel') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Exportar Excel
            </a>
            <a href="{{ route('reportes.export.pdf') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
            </a>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('reportes.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $fechaInicio }}">
                </div>
                <div class="col-md-3">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ $fechaFin }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filtrar
                    </button>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('reportes.filtro', 'hoy') }}" class="btn btn-outline-secondary">Hoy</a>
                        <a href="{{ route('reportes.filtro', 'semana') }}" class="btn btn-outline-secondary">Semana</a>
                        <a href="{{ route('reportes.filtro', 'mes') }}" class="btn btn-outline-secondary">Mes</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Estadísticas del Período -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Scrap</h5>
                    <p class="card-text fs-2">{{ number_format($totalScrap) }}</p>
                    <small>unidades en el período</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Total Reproceso</h5>
                    <p class="card-text fs-2">{{ number_format($totalReproceso) }}</p>
                    <small>unidades en el período</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Registros</h5>
                    <p class="card-text fs-2">{{ number_format($totalRegistros) }}</p>
                    <small>fallas registradas</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Registros -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">Detalle de Fallas</h5>
        </div>
        <div class="card-body">
            @if($registros->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablaReportes">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                                <th>Motivo</th>
                                <th>Fecha</th>
                                <th>Creado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registros as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>
                                        @if($r->tipo === 'Scrap')
                                            <span class="badge bg-danger">Scrap</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Reproceso</span>
                                        @endif
                                    </td>
                                    <td>{{ $r->cantidad }}</td>
                                    <td>{{ $r->motivo }}</td>
                                    <td>{{ $r->fecha->format('d/m/Y H:i') }}</td>
                                    <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Mostrando {{ $registros->count() }} de {{ $totalRegistros }} registros
                    </div>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1"></i>
                    <p class="mt-2">No hay registros en el período seleccionado</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Validar que fecha fin no sea menor a fecha inicio
    document.querySelector('form').addEventListener('submit', function(e) {
        const inicio = document.getElementById('fecha_inicio').value;
        const fin = document.getElementById('fecha_fin').value;
        
        if (inicio && fin && inicio > fin) {
            e.preventDefault();
            alert('La fecha de inicio no puede ser mayor a la fecha fin');
        }
    });
</script>
@endsection

