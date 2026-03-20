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
        Schema::create('scraps', function (Blueprint $table) {
            $table->id();
            
            // Relación: Esto conecta el scrap con un usuario (Entidad-Relación)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Campos de información
            $table->date('fecha');
            $table->string('concepto');
            
            // Campos de costos (10 dígitos en total, 2 decimales)
            $table->decimal('costo_incremental', 10, 2);
            $table->decimal('valor_recuperacion', 10, 2);
            
            // Campo opcional para detalles extras
            $table->text('observaciones')->nullable();
            
            $table->timestamps(); // Crea created_at y updated_at automáticamente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scraps');
    }
};