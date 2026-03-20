<?php

namespace App\Http\Controllers;

use App\Exports\FallasExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportesController extends Controller
{
    public function exportExcel(Request $request)
    {
        $filters = $request->only(['fecha_inicio', 'fecha_fin', 'tipo']);
        return Excel::download(new FallasExport($filters), 'reporte_fallas.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $filters = $request->only(['fecha_inicio', 'fecha_fin', 'tipo']);
        
        // Obtener los datos filtrados
        $query = \App\Models\RegistroFalla::query();
        
        if ($filters['fecha_inicio']) {
            $query->whereDate('created_at', '>=', $filters['fecha_inicio']);
        }
        
        if ($filters['fecha_fin']) {
            $query->whereDate('created_at', '<=', $filters['fecha_fin']);
        }
        
        if ($filters['tipo']) {
            $query->where('tipo', $filters['tipo']);
        }
        
        $registros = $query->get();
        
        $pdf = Pdf::loadView('reportes.pdf', compact('registros', 'filters'));
        return $pdf->download('reporte_fallas.pdf');
    }
}