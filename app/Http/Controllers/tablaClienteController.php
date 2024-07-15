<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\historialCliete;
use App\Models\ReporteHistorial;
use Barryvdh\DomPDF\Facade\Pdf;

class tablaClienteController extends Controller
{
    public function imprimir(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $clientes = Formulario::all();
        return view('tablaCliente', compact('clientes'));
    }

    public function eliminarCliente($id): \Illuminate\Http\RedirectResponse
    {
        $record = Formulario::findOrFail($id);
        $record->delete();

        return redirect()->back()->with('success', 'Registro eliminado correctamente');
    }
    public function editar($id)
    {
        $cliente = Formulario::findOrFail($id); // Recupera el cliente por su ID

        return view('editar', compact('cliente'));
    }
    public function actualizar(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50',
            'telefono' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'numero_cuenta' => 'required|string|max:20',
            'saldo' => 'required|numeric',
            'fecha_apertura' => 'required|date',
            'empleador' => 'required|string|max:255',
            'ingresos' => 'required|numeric',
            'autorizacion_datos' => 'required|boolean',
            'consentimiento_comunicaciones' => 'required|boolean',
        ]);

        // Buscar el cliente por ID y actualizar sus datos
        $cliente = Formulario::findOrFail($id);
        $cliente->update([
            'nombre' => $request->nombre,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'direccion' => $request->direccion,
            'identificacion' => $request->identificacion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'numero_cuenta' => $request->numero_cuenta,
            'saldo' => $request->saldo,
            'fecha_apertura' => $request->fecha_apertura,
            'empleador' => $request->empleador,
            'ingresos' => $request->ingresos,
            'autorizacion_datos' => $request->autorizacion_datos,
            'consentimiento_comunicaciones' => $request->consentimiento_comunicaciones,
        ]);

        // Redirigir a la vista de listado de clientes con un mensaje de éxito
        return redirect()->route('tablaCliente.imprimirtablaClientes')->with('success', 'Cliente actualizado con éxito');
    }
    public function getClientFinancialData($identificacion)
    {
        // Usar el modelo para realizar la consulta


        $data = historialCliete::select(
            'fecha_movimiento',
            historialCliete::raw('SUM(CASE WHEN movimiento = true THEN cantidad ELSE 0 END) AS abonos'),
            historialCliete::raw('SUM(CASE WHEN movimiento = false THEN cantidad ELSE 0 END) AS retiros'),
            historialCliete::raw('SUM(CASE WHEN movimiento = true THEN cantidad ELSE -cantidad END) AS saldo')
        )
            ->where('identificacion', $identificacion)
            ->groupBy('fecha_movimiento')
            ->orderBy('fecha_movimiento')
            ->get();

        // Retornar los datos en formato JSON
        return response()->json($data);
    }
    public function generarPdf($identificacion): \Illuminate\Http\Response
    {

        // Buscar el cliente por identificación
        $cliente = Formulario::where('identificacion', $identificacion)->firstOrFail();

        $historial = ReporteHistorial::obtenerHistorialConSaldo($identificacion);

        $data = [
            'movimientos' => $historial,
            'cliente' => $cliente,
        ];

        // Cargar la vista del PDF y pasar los datos
        $pdf = PDF::loadView('pdfHistorialCliente', $data);
        return $pdf->download('historial-abonos: '.$cliente->identificacion.'.pdf');
    }
}
