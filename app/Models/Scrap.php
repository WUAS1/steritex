<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
    protected $fillable = [
        'user_id', 
        'fecha', 
        'concepto', 
        'costo_incremental', 
        'valor_recuperacion', 
        'observaciones'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}