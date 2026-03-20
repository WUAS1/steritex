{{-- resources/views/fallas/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Registro de Fallas - Steritex')

@section('styles')
<style>
    :root {
        --rojo-pastel: #ff6b6b;
        --rojo-suave: #ff8787;
        --blanco-pastel: #fff5f5;
        --gris-suave: #f8f9fa;
    }
    
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(255, 107, 107, 0.1);
    }
    
    .card-header {
        background: linear-gradient(135deg, var(--blanco-pastel) 0%, #ffffff 100%);
        border-bottom: 2px solid var(--rojo-pastel);
        border-radius: 15px 15px 0 0 !important;
        padding: 1rem 1.5rem;
    }
    
    .btn-primary {
        background-color: var(--rojo-pastel);
        border-color: var(--rojo-pastel);
        color: white;
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }
    
    .btn-primary:hover {
        background-color: var(--rojo-suave);
        border-color: var(--rojo-suave);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);
    }
    
    .btn-outline-primary {
        color: var(--rojo-pastel);
        border-color: var(--rojo-pastel);
        border-radius: 8px;
    }
    
    .btn-outline-primary:hover {
        background-color: var(--rojo-pastel);
        border-color: var(--rojo-pastel);
        color: white;
    }
    
    .btn-success, .btn-danger {
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
        border: none;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
        border: none;
    }
    
    .badge.bg-danger {
        background: linear-gradient(135deg, var(--rojo-pastel) 0%, #ff5252 100%) !important;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .badge.bg-warning {
        background: linear-gradient(135deg, #ffd93e 0%, #ffc107 100%) !important;
        color: #333 !important;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 0.6rem 1rem;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--rojo-pastel);
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
    }
    
    .table {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .table thead th {
        background-color: var(--blanco-pastel);
        color: #333;
        font-weight: 600;
        border-bottom: 2px solid var(--rojo-pastel);
    }
    
    .table tbody tr:hover {
        background-color: var(--blanco-pastel);
    }
    
    .bg-danger.card, .bg-warning.card {
        background: linear-gradient(135deg, var(--rojo-pastel) 0%, #ff5252 100%) !important;
        border: none;
        border-radius: 15px;
    }
    
    .bg-warning.card {
        background: linear-gradient(135deg, #ffd93e 0%, #ffc107 100%) !important;
    }
    
    .text-muted {
        color: #6c757d !important;
        font-size: 0.875rem;
    }
    
    .export-section {
        background-color: var(--blanco-pastel);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<div class="py-4 container-fluid">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-6 fw-bold" style="color: var(--rojo-pastel);">
                <i class="bi bi-exclamation-triangle-fill"></i> Registro de Fallas
            </h1>
            <p class="text-muted mb-0">Sistema de conteo de unidades (Scrap y Reproceso)</p>
        </div>
        @auth
            @if(auth()->user()->isAdministrador())
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary me-2">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('reportes.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-bar-chart"></i> Reportes
                </a>
            </div>
            @endif
        @endauth
    </div>

    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="bi bi-funnel-fill" style="color: var(--rojo-pastel);"></i> Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('fallas.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="fecha_inicio" class="form-label">Desde</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" 
                           value="{{ request('fecha_inicio') }}">
                </div>
                <div class="col-md-3">
                    <label for="fecha_fin" class="form-label">Hasta</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" 
                           value="{{ request('fecha_fin') }}">
                </div>
                <div class="col-md-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select name="tipo" id="tipo" class="form-select">
                        <option value="">Todos</option>
                        <option value="Scrap" {{ request('tipo') == 'Scrap' ? 'selected' : '' }}>Scrap</option>
                        <option value="Reproceso" {{ request('tipo') == 'Reproceso' ? 'selected' : '' }}>Reproceso</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search"></i> Filtrar
                    </button>
                    <a href="{{ route('fallas.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Limpiar
                    </a>
                </div>
            </form>
            
            <!-- Sección de exportación integrada -->
            <div class="export-section mt-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-download me-2" style="color: var(--rojo-pastel);"></i>
                    <span class="fw-medium me-3">Exportar datos:</span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-success btn-sm" onclick="exportToExcel()">
                            <i class="bi bi-file-earmark-excel-fill"></i> Excel
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="exportToPDF()">
                            <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="printReport()">
                            <i class="bi bi-printer-fill"></i> Imprimir
                        </button>
                    </div>
                </div>
                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle"></i> Los reportes se generarán con los filtros actuales
                </small>
            </div>
        </div>
    </div>

    <!-- Resumen de totales -->
    <div class="row mb-4 g-4">
        <div class="col-md-6">
            <div class="card text-white bg-danger">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-trash-fill fs-1"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Total Scrap</h5>
                        <p class="card-text fs-2 fw-bold mb-0">{{ number_format($totalScrap) }}</p>
                        <small>unidades</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-warning">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-arrow-repeat fs-1"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Total Reproceso</h5>
                        <p class="card-text fs-2 fw-bold mb-0">{{ number_format($totalReproceso) }}</p>
                        <small>unidades</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de Registro -->
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="bi bi-plus-circle-fill" style="color: var(--rojo-pastel);"></i> Nuevo Registro</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('fallas.store') }}" method="POST" id="registroForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="tipo" class="form-label">Tipo de Falla</label>
                        <select name="tipo" id="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
                            <option value="Scrap" {{ old('tipo')=='Scrap'?'selected':'' }}>Scrap</option>
                            <option value="Reproceso" {{ old('tipo')=='Reproceso'?'selected':'' }}>Reproceso</option>
                        </select>
                        @error('tipo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-2">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" 
                               class="form-control @error('cantidad') is-invalid @enderror" 
                               value="{{ old('cantidad') }}" min="1" required>
                        <small class="text-muted">Unidades</small>
                        @error('cantidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label for="motivo" class="form-label">Motivo</label>
                        <input type="text" name="motivo" id="motivo" 
                               class="form-control @error('motivo') is-invalid @enderror" 
                               value="{{ old('motivo') }}" placeholder="Descripción de la falla" required>
                        @error('motivo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-2">
                        <label for="fecha_date" class="form-label">Fecha</label>
                        <input type="date" name="fecha_date" id="fecha_date" 
                               class="form-control @error('fecha_date') is-invalid @enderror" 
                               value="{{ old('fecha_date', date('Y-m-d')) }}" required>
                        @error('fecha_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-1">
                        <label for="fecha_time" class="form-label">Hora</label>
                        <input type="time" name="fecha_time" id="fecha_time" 
                               class="form-control @error('fecha_time') is-invalid @enderror" 
                               value="{{ old('fecha_time', date('H:i')) }}" required>
                        @error('fecha_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle-fill"></i> Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Registros -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-list-ul" style="color: var(--rojo-pastel);"></i> Historial de Registros</h5>
            <span class="badge" style="background-color: var(--rojo-pastel); color: white;">{{ $registros->count() }} registros</span>
        </div>
        <div class="card-body">
            @if($registros->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="registrosTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                                <th>Motivo</th>
                                <th>Fecha</th>
                                @auth
                                    @if(auth()->user()->isAdministrador())
                                        <th>Acciones</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registros as $r)
                                <tr>
                                    <td class="fw-medium">#{{ $r->id }}</td>
                                    <td>
                                        @if($r->tipo === 'Scrap')
                                            <span class="badge bg-danger">Scrap</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Reproceso</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">{{ number_format($r->cantidad) }}</td>
                                    <td>{{ $r->motivo }}</td>
                                    <td>{{ $r->fecha->format('d/m/Y H:i') }}</td>
                                    @auth
                                        @if(auth()->user()->isAdministrador())
                                            <td>
                                                <form action="{{ route('fallas.destroy', $r->id) }}" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                @if(method_exists($registros, 'links'))
                    <div class="mt-4">
                        {{ $registros->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox-fill fs-1" style="color: var(--rojo-pastel); opacity: 0.5;"></i>
                    <p class="mt-3 text-muted">No hay registros disponibles</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Scripts para exportación -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

<script>
function getCurrentFilters() {
    const urlParams = new URLSearchParams(window.location.search);
    return {
        fecha_inicio: urlParams.get('fecha_inicio') || '',
        fecha_fin: urlParams.get('fecha_fin') || '',
        tipo: urlParams.get('tipo') || ''
    };
}

function getTableData() {
    const table = document.getElementById('registrosTable');
    if (!table) return [];
    
    const data = [];
    const rows = table.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const tipoCell = cells[1].querySelector('.badge');
        const tipo = tipoCell ? tipoCell.textContent.trim() : cells[1].textContent.trim();
        
        data.push({
            ID: cells[0].textContent.trim().replace('#', ''),
            Tipo: tipo,
            Cantidad: cells[2].textContent.trim(),
            Motivo: cells[3].textContent.trim(),
            Fecha: cells[4].textContent.trim()
        });
    });
    
    return data;
}

function exportToExcel() {
    const data = getTableData();
    if (data.length === 0) {
        alert('No hay datos para exportar');
        return;
    }
    
    // Crear libro de Excel
    const wb = XLSX.utils.book_new();
    
    // Crear hoja de datos
    const ws = XLSX.utils.json_to_sheet(data);
    
    // Ajustar ancho de columnas
    const colWidths = [
        { wch: 10 }, // ID
        { wch: 15 }, // Tipo
        { wch: 12 }, // Cantidad
        { wch: 40 }, // Motivo
        { wch: 20 }  // Fecha
    ];
    ws['!cols'] = colWidths;
    
    // Agregar hoja al libro
    XLSX.utils.book_append_sheet(wb, ws, 'Registro de Fallas');
    
    // Agregar hoja de resumen
    const filters = getCurrentFilters();
    const summaryData = [
        { 'Métrica': 'Total Scrap', 'Valor': '{{ $totalScrap }}' },
        { 'Métrica': 'Total Reproceso', 'Valor': '{{ $totalReproceso }}' },
        { 'Métrica': 'Fecha Inicio', 'Valor': filters.fecha_inicio || 'No especificada' },
        { 'Métrica': 'Fecha Fin', 'Valor': filters.fecha_fin || 'No especificada' },
        { 'Métrica': 'Tipo Filtrado', 'Valor': filters.tipo || 'Todos' },
        { 'Métrica': 'Fecha de Exportación', 'Valor': new Date().toLocaleString('es-ES') }
    ];
    
    const wsSummary = XLSX.utils.json_to_sheet(summaryData);
    XLSX.utils.book_append_sheet(wb, wsSummary, 'Resumen');
    
    // Guardar archivo
    const fecha = new Date().toISOString().split('T')[0];
    XLSX.writeFile(wb, `registro_fallas_${fecha}.xlsx`);
}

function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const data = getTableData();
    
    if (data.length === 0) {
        alert('No hay datos para exportar');
        return;
    }
    
    // Crear documento PDF
    const doc = new jsPDF({
        orientation: 'landscape',
        unit: 'mm',
        format: 'a4'
    });
    
    // Configurar colores corporativos
    const primaryColor = [255, 107, 107]; // Rojo pastel
    
    // Título del documento
    doc.setFontSize(20);
    doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
    doc.text('Registro de Fallas - Steritex', 14, 15);
    
    // Subtítulo con filtros
    doc.setFontSize(10);
    doc.setTextColor(100, 100, 100);
    const filters = getCurrentFilters();
    let filterText = 'Filtros aplicados: ';
    if (filters.fecha_inicio) filterText += `Desde ${filters.fecha_inicio} `;
    if (options.filters.fecha_fin) filterText += `Hasta ${filters.fecha_fin} `;
    if (filters.tipo) filterText += `Tipo: ${filters.tipo}`;
    if (filterText === 'Filtros aplicados: ') filterText += 'Ninguno';
    doc.text(filterText, 14, 22);
    
    // Fecha de exportación
    doc.text(`Exportado: ${new Date().toLocaleString('es-ES')}`, 14, 27);
    
    // Preparar datos para la tabla
    const tableData = data.map(item => [item.ID, item.Tipo, item.Cantidad, item.Motivo, item.Fecha]);
    
    // Configurar tabla
    doc.autoTable({
        head: [['ID', 'Tipo', 'Cantidad', 'Motivo', 'Fecha']],
        body: tableData,
        startY: 30,
        theme: 'grid',
        styles: {
            fontSize: 8,
            cellPadding: 3,
            lineColor: [200, 200, 200],
            lineWidth: 0.1
        },
        headStyles: {
            fillColor: primaryColor,
            textColor: [255, 255, 255],
            fontStyle: 'bold',
            halign: 'center'
        },
        alternateRowStyles: {
            fillColor: [255, 245, 245]
        },
        columnStyles: {
            0: { cellWidth: 15, halign: 'center' },
            1: { cellWidth: 25, halign: 'center' },
            2: { cellWidth: 20, halign: 'center' },
            3: { cellWidth: 100 },
            4: { cellWidth: 35, halign: 'center' }
        }
    });
    
    // Agregar página de resumen
    doc.addPage();
    doc.setFontSize(16);
    doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
    doc.text('Resumen de Registros', 14, 15);
    
    const summaryData = [
        ['Total Scrap', '{{ $totalScrap }} unidades'],
        ['Total Reproceso', '{{ $totalReproceso }} unidades'],
        ['Total General', '{{ $totalScrap + $totalReproceso }} unidades'],
        ['Período', filters.fecha_inicio && filters.fecha_fin ? 
            `${filters.fecha_inicio} al ${filters.fecha_fin}` : 'Todos los registros'],
        ['Tipo filtrado', filters.tipo || 'Todos'],
        ['Total registros', data.length.toString()]
    ];
    
    doc.autoTable({
        body: summaryData,
        startY: 25,
        theme: 'plain',
        styles: {
            fontSize: 11,
            cellPadding: 5
        },
        columnStyles: {
            0: { fontStyle: 'bold', cellWidth: 60 },
            1: { cellWidth: 100 }
        }
    });
    
    // Guardar PDF
    const fecha = new Date().toISOString().split('T')[0];
    doc.save(`registro_fallas_${fecha}.pdf`);
}

function printReport() {
    // Crear una ventana para impresión
    const printWindow = window.open('', '_blank');
    
    const data = getTableData();
    const filters = getCurrentFilters();
    
    let htmlContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Registro de Fallas - Steritex</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                    color: #333;
                }
                h1 {
                    color: #ff6b6b;
                    border-bottom: 2px solid #ff6b6b;
                    padding-bottom: 10px;
                }
                .header {
                    margin-bottom: 20px;
                }
                .filters {
                    background-color: #fff5f5;
                    padding: 10px;
                    border-radius: 5px;
                    margin-bottom: 20px;
                }
                .summary {
                    display: flex;
                    gap: 20px;
                    margin-bottom: 20px;
                }
                .summary-box {
                    flex: 1;
                    padding: 15px;
                    border-radius: 5px;
                    color: white;
                }
                .scrap-box {
                    background: linear-gradient(135deg, #ff6b6b, #ff5252);
                }
                .reproceso-box {
                    background: linear-gradient(135deg, #ffd93e, #ffc107);
                    color: #333;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th {
                    background-color: #ff6b6b;
                    color: white;
                    padding: 10px;
                    text-align: left;
                }
                td {
                    padding: 8px;
                    border-bottom: 1px solid #ddd;
                }
                tr:nth-child(even) {
                    background-color: #fff5f5;
                }
                .footer {
                    margin-top: 20px;
                    text-align: right;
                    color: #666;
                    font-size: 12px;
                }
            </style>
        </head>
        <body>
            <h1>Registro de Fallas - Steritex</h1>
            
            <div class="header">
                <p><strong>Fecha de impresión:</strong> ${new Date().toLocaleString('es-ES')}</p>
            </div>
            
            <div class="filters">
                <h3>Filtros aplicados:</h3>
                <p>Desde: ${filters.fecha_inicio || 'No especificado'} | Hasta: ${filters.fecha_fin || 'No especificado'} | Tipo: ${filters.tipo || 'Todos'}</p>
            </div>
            
            <div class="summary">
                <div class="summary-box scrap-box">
                    <h3>Total Scrap</h3>
                    <h2>{{ number_format($totalScrap) }} unidades</h2>
                </div>
                <div class="summary-box reproceso-box">
                    <h3>Total Reproceso</h3>
                    <h2>{{ number_format($totalReproceso) }} unidades</h2>
                </div>
            </div>
            
            <h3>Detalle de Registros</h3>
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
    `;
    
    data.forEach(item => {
        htmlContent += `
            <tr>
                <td>${item.ID}</td>
                <td>${item.Tipo}</td>
                <td>${item.Cantidad}</td>
                <td>${item.Motivo}</td>
                <td>${item.Fecha}</td>
            </tr>
        `;
    });
    
    htmlContent += `
                </tbody>
            </table>
            
            <div class="footer">
                <p>Total de registros: ${data.length}</p>
            </div>
        </body>
        </html>
    `;
    
    printWindow.document.write(htmlContent);
    printWindow.document.close();
    printWindow.print();
}
</script>
@endsection