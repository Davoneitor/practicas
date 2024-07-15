<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function mostrarFormulario()
    {
        return view('formulario'); // Aquí 'formulario' es el nombre de tu vista blade
    }

    public function procesarFormulario(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255',
            'numero_cuenta' => 'required|string|max:255',
            'saldo' => 'required|numeric',
            'fecha_apertura' => 'required|date',
            'empleador' => 'required|string|max:255',
            'ingresos' => 'required|numeric',
            'autorizacion_datos' => 'required|boolean',
            'consentimiento_comunicaciones' => 'required|boolean',
        ]);

        // Crear una nueva instancia del modelo Formulario y guardar los datos
        $form = new Formulario($validatedData);
        $form->save();


        return redirect()->back()->with('message', '¡Formulario enviado correctamente!');

    }
}
