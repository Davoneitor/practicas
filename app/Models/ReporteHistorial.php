<?php

// app/Models/HistorialAbonos.php (suponiendo que este sea el nombre de tu modelo)
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReporteHistorial extends Model
{
    protected $table = 'historial_abonos'; // Nombre de tu tabla

    public static function obtenerHistorialConSaldo($identificacion)
    {
        // Consulta personalizada
        $consulta = DB::select("
            SELECT fecha_movimiento,
                   abonos,
                   retiros,
                   @saldo := @saldo + abonos - retiros AS saldo
            FROM (
                SELECT fecha_movimiento,
                       SUM(CASE WHEN movimiento = true THEN cantidad ELSE 0 END) AS abonos,
                       SUM(CASE WHEN movimiento = false THEN cantidad ELSE 0 END) AS retiros
                FROM historial_abonos
                WHERE identificacion = ?
                GROUP BY fecha_movimiento
                ORDER BY fecha_movimiento
            ) AS subquery,
            (SELECT @saldo := 0) AS init
        ", [$identificacion]);

        return collect($consulta); // Convertir resultado en una colección de Laravel
    }
}



