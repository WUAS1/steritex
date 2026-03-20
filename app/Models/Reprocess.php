<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reprocess extends Model
{
    
    protected $fillable = [
        'user_id', 
        'fecha', 
        'concepto', 
        'costo_incremental', 
        'valor_recuperacion', 
        'descripcion_defecto',
        'cantidad_unidades'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}