<?php

namespace App\Exports;

use App\Models\RegistroFalla;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FallasExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = RegistroFalla::query();
        
        // Aplicar filtros si existen
        if (!empty($this->filters['fecha_inicio'])) {
            $query->whereDate('fecha', '>=', $this->filters['fecha_inicio']);
        }
        
        if (!empty($this->filters['fecha_fin'])) {
            $query->whereDate('fecha', '<=', $this->filters['fecha_fin']);
        }
        
        if (!empty($this->filters['tipo'])) {
            $query->where('tipo', $this->filters['tipo']);
        }
        
        return $query->orderBy('fecha', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo',
            'Cantidad',
            'Motivo',
            'Fecha',
            'Creado',
            'Actualizado'
        ];
    }

    public function map($falla): array
    {
        return [
            $falla->id,
            $falla->tipo,
            $falla->cantidad,
            $falla->motivo,
            $falla->fecha->format('Y-m-d H:i:s'),
            $falla->created_at->format('Y-m-d H:i:s'),
            $falla->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}