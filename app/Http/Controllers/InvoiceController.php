<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Formulario;

class InvoiceController extends Controller
{
    public function generatePDF($id)
    {


        $invoice  = Formulario::all();







        $pdf = PDF::loadView('invoice', compact('invoice'));
        return $pdf->download('invoice.pdf');
    }
}
