<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    protected $table = 'formulario_clientes';

    protected $fillable = [
        'id',
        'nombre',
        'fecha_nacimiento',
        'direccion',
        'identificacion',
        'telefono',
        'email',
        'numero_cuenta',
        'saldo',
        'fecha_apertura',
        'empleador',
        'ingresos',
        'autorizacion_datos',
        'consentimiento_comunicaciones',
    ];
}

