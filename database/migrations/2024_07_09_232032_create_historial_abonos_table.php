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
        Schema::create('historial_abonos', function (Blueprint $table) {

            $table->string('identificacion');
            $table->boolean('movimiento');
            $table->date('fecha_movimiento');
            $table->decimal('cantidad', 10, 2);
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('identificacion')->references('identificacion')->on('formulario_clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_abonos');
    }
};
