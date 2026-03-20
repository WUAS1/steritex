@extends('layouts.app')

@section('title', 'Dashboard - Administrador')

@section('content')
<div class="py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="bi bi-speedometer2"></i> Dashboard</h2>
            <p class="text-muted mb-0">Panel de Control - Administrador</p>
        </div>
        <div>
            <span class="text-muted">
                <i class="bi bi-calendar"></i> {{ now()->format('d/m/Y H:i') }}
            </span>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-4">
        <!-- Total Scrap -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2">Total Scrap</p>
                            <h2 class="mb-0 text-danger">{{ number_format($totalScrap) }}</h2>
                            <small class="text-muted">unidades</small>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-trash text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Reproceso -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card stat-card h-100" style="border-left-color: #f39c12;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2">Total Reproceso</p>
                            <h2 class="mb-0" style="color: #f39c12;">{{ number_format($totalReproceso) }}</h2>
                            <small class="text-muted">unidades</small>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-arrow-repeat text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrap Hoy -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card stat-card h-100" style="border-left-color: #e74c3c;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2">Scrap Hoy</p>
                            <h2 class="mb-0">{{ number_format($scrapHoy) }}</h2>
                            <small class="text-muted">unidades</small>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-calendar-check text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Registros -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card stat-card h-100" style="border-left-color: #3498db;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2">Total Registros</p>
                            <h2 class="mb-0">{{ number_format($totalRegistros) }}</h2>
                            <small class="text-muted">fallas</small>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-file-text text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda fila: Accesos rápidos y Registros Recientes -->
    <div class="row">
        <!-- Accesos Rápidos -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-lightning"></i> Accesos Rápidos</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('reportes.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-bar-chart me-2"></i> Ver Reportes
                        </a>
                        <a href="{{ route('reportes.export', ['fecha_inicio' => now()->startOfMonth()->toDateString(), 'fecha_fin' => now()->endOfMonth()->toDateString()]) }}" class="btn btn-outline-success">
                            <i class="bi bi-download me-2"></i> Exportar CSV
                        </a>
                        <a href="{{ route('fallas.index') }}" class="btn btn-outline-warning">
                            <i class="bi bi-plus-circle me-2"></i> Nuevo Registro
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registros Recientes -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-clock-history"></i> Registros Recientes</h5>
                    <a href="{{ route('fallas.index') }}" class="btn btn-sm btn-primary">Ver Todos</a>
                </div>
                <div class="card-body">
                    @if($registrosRecientes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Cantidad</th>
                                        <th>Motivo</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrosRecientes as $r)
                                        <tr>
                                            <td>
                                                @if($r->tipo === 'Scrap')
                                                    <span class="badge bg-danger">Scrap</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Reproceso</span>
                                                @endif
                                            </td>
                                            <td>{{ $r->cantidad }}</td>
                                            <td>{{ Str::limit($r->motivo, 30) }}</td>
                                            <td>{{ $r->fecha->format('d/m H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-1"></i>
                            <p class="mt-2">No hay registros aún</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas Mensuales -->
    @if($statsMensuales->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up"></i> Estadísticas por Mes (Últimos 6 meses)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Mes</th>
                                    <th class="text-center">Scrap</th>
                                    <th class="text-center">Reproceso</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statsMensuales as $stat)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::createFromDate($stat->anio, $stat->mes)->format('F Y') }}</td>
                                        <td class="text-center text-danger">{{ number_format($stat->total_scrap) }}</td>
                                        <td class="text-center text-warning">{{ number_format($stat->total_reproceso) }}</td>
                                        <td class="text-center fw-bold">{{ number_format($stat->total_scrap + $stat->total_reproceso) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

