<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\FormularioController;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formulario_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha_nacimiento');
            $table->string('direccion');
            $table->string('identificacion')->unique();
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('numero_cuenta')->unique();
            $table->decimal('saldo', 15, 2);
            $table->date('fecha_apertura');
            $table->string('empleador');
            $table->decimal('ingresos', 15, 2);
            $table->boolean('autorizacion_datos');
            $table->boolean('consentimiento_comunicaciones');
            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulario_clientes');
    }
};
