<?php

namespace App\Http\Controllers;

use App\Models\RegistroFalla;
use App\Mail\AlertaCantidadExcedida;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FallaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = RegistroFalla::orderBy('fecha', 'desc')->get();

        $totalScrap = RegistroFalla::where('tipo', 'Scrap')->sum('cantidad');
        $totalReproceso = RegistroFalla::where('tipo', 'Reproceso')->sum('cantidad');

        return view('fallas.index', compact('registros', 'totalScrap', 'totalReproceso'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo' => 'required|in:Scrap,Reproceso',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'required|string',
            'fecha_date' => 'required|date',
            'fecha_time' => 'required',
        ]);

        // Combinar fecha y hora en un solo datetime
        $fechaCompleta = Carbon::createFromFormat(
            'Y-m-d H:i',
            $data['fecha_date'] . ' ' . $data['fecha_time']
        );

        $registro = RegistroFalla::create([
            'tipo' => $data['tipo'],
            'cantidad' => $data['cantidad'],
            'motivo' => $data['motivo'],
            'fecha' => $fechaCompleta,
        ]);

        // Enviar alerta si la cantidad excede 50
        if ($data['cantidad'] > 50) {
            Mail::to('admin@steritex.com')->send(new AlertaCantidadExcedida([
                'fecha' => $fechaCompleta->format('Y-m-d'),
                'turno' => 'No especificado',
                'operario' => 'No especificado',
                'area' => 'No especificado',
                'proceso' => 'No especificado',
                'producto' => 'No especificado',
                'cantidad' => $data['cantidad'],
                'defecto' => $data['motivo'],
                'observaciones' => 'No especificado'
            ]));
        }

        return redirect()->route('fallas.index')->with('success', 'Registro agregado exitosamente.');
    }
}
