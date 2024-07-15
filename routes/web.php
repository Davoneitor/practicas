<?php

// routes/web.php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\tablaClienteController;




// Dentro de routes/web.php
if (App::environment('production')) {
    URL::forceScheme('https');
}
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Ruta para mostrar el formulario
Route::get('/formulario/mostrar', [FormularioController::class, 'mostrarFormulario'])->name('formulario.mostrar');
Route::post('/formulario/procesar', [FormularioController::class, 'procesarFormulario'])->name('formulario.procesar');

// Rutas para la tabla de clientes

Route::match(['get', 'post'], '/tablaCliente', [tablaClienteController::class, 'imprimir'])->name('tablaCliente.imprimirtablaClientes');
Route::delete('/tablaCliente/{id}', [tablaClienteController::class, 'eliminarCliente'])->name('tablaCliente.eliminarCliente');
Route::get('/tablaCliente/{id}/editar', [tablaClienteController::class, 'editar'])->name('tablaCliente.editar');
Route::put('/tablaCliente/actualizar/{id}', [tablaClienteController::class, 'actualizar'])->name('tablaCliente.actualizar');
Route::get('/tablaCliente/{identificacion}/financial-data', [tablaClienteController::class, 'getClientFinancialData']);



Route::get('/pdfHistorial/{identificacion}', [tablaClienteController::class, 'generarPdf'])->name('pdfHistorial');
