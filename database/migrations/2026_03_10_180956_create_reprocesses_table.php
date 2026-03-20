<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reprocesses', function (Blueprint $table) {
            $table->id();
            
            // Relación con el usuario que registra el reproceso
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Datos del registro
            $table->date('fecha');
            $table->string('concepto');
            
            // Campos de costos (basados en tu nueva fórmula)
            $table->decimal('costo_incremental', 10, 2);
            $table->decimal('valor_recuperacion', 10, 2);
            
            // Información adicional
            $table->text('descripcion_defecto')->nullable();
            $table->integer('cantidad_unidades')->default(1);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reprocesses');
    }
};
