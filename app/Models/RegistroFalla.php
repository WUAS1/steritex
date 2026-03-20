<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroFalla extends Model
{
    protected $table = 'registros_fallas';

    protected $fillable = [
        'tipo',
        'cantidad',
        'motivo',
        'fecha',
    ];

    public $timestamps = true;

    protected $casts = [
        'fecha' => 'datetime',
    ];
}
