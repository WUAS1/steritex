<?php

namespace App\Http\Controllers;

use App\Models\RegistroFalla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Mostrar dashboard del Administrador
     */
    public function index(Request $request)
    {
        // Totales generales
        $totalScrap = RegistroFalla::where('tipo', 'Scrap')->sum('cantidad');
        $totalReproceso = RegistroFalla::where('tipo', 'Reproceso')->sum('cantidad');
        
        // Registros recientes (últimos 10)
        $registrosRecientes = RegistroFalla::orderBy('created_at', 'desc')->limit(10)->get();
        
        // Estadísticas por mes (últimos 6 meses)
        $statsMensuales = RegistroFalla::select(
            DB::raw('MONTH(fecha) as mes'),
            DB::raw('YEAR(fecha) as anio'),
            DB::raw('SUM(CASE WHEN tipo = "Scrap" THEN cantidad ELSE 0 END) as total_scrap'),
            DB::raw('SUM(CASE WHEN tipo = "Reproceso" THEN cantidad ELSE 0 END) as total_reproceso')
        )
        ->where('fecha', '>=', now()->subMonths(6))
        ->groupBy(DB::raw('YEAR(fecha), MONTH(fecha)'))
        ->orderBy('anio')
        ->orderBy('mes')
        ->get();
        
        // Totales de hoy
        $scrapHoy = RegistroFalla::where('tipo', 'Scrap')
            ->whereDate('fecha', today())
            ->sum('cantidad');
            
        $reprocesoHoy = RegistroFalla::where('tipo', 'Reproceso')
            ->whereDate('fecha', today())
            ->sum('cantidad');
            
        // Total de registros
        $totalRegistros = RegistroFalla::count();
        
        return view('dashboard.index', compact(
            'totalScrap', 
            'totalReproceso', 
            'registrosRecientes',
            'statsMensuales',
            'scrapHoy',
            'reprocesoHoy',
            'totalRegistros'
        ));
    }
}

