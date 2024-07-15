<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historialCliete extends Model
{
    // Especifica el nombre de la tabla si no sigue la convención plural
    protected $table = 'historial_abonos';

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'identificacion', 'fecha_movimiento', 'cantidad', 'movimiento'
    ];

    // Si usas timestamps, puedes definirlo aquí. Si no tienes las columnas created_at y updated_at en tu tabla, puedes desactivar esto.
    public $timestamps = false; // Establece a true si tienes columnas `created_at` y `updated_at`
}
