<?php

namespace App\Observers;

use App\Models\RegistroFalla;
use App\Mail\ScrapExcedido;
use Illuminate\Support\Facades\Mail;

class RegistroFallaObserver
{
    /**
     * Handle the RegistroFalla "created" event.
     */
    public function created(RegistroFalla $registroFalla): void
    {
        // Verificar si es Scrap y si supera las 10 unidades
        if ($registroFalla->tipo === 'Scrap' && $registroFalla->cantidad > 10) {
            $this->enviarAlertaScrap($registroFalla);
        }
    }

    /**
     * Handle the RegistroFalla "updated" event.
     */
    public function updated(RegistroFalla $registroFalla): void
    {
        // Verificar si es Scrap y si supera las 10 unidades
        if ($registroFalla->tipo === 'Scrap' && $registroFalla->cantidad > 10) {
            $this->enviarAlertaScrap($registroFalla);
        }
    }

    /**
     * Enviar alerta por correo cuando se excede el límite de Scrap
     */
    private function enviarAlertaScrap(RegistroFalla $registro): void
    {
        // Obtener correo del administrador desde configuración
        $emailAdmin = config('app.email_admin', 'admin@steritex.com');
        
        // Enviar correo con la notificación
        Mail::to($emailAdmin)->send(new ScrapExcedido($registro));
    }
}

