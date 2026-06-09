<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Lista de pagos realizados.
     */
    public function index(Request $request)
    {
        // TODO: Obtener pagos con relaciones a contribuyente y deuda
        // TODO: Filtrar por fecha, contribuyente, estado
        // $pagos = Pago::with(['contribuyente', 'deuda'])
        //     ->orderByDesc('fecha_pago')
        //     ->paginate(15);

        return view('admin.pagos.index');
    }

    /**
     * Muestra el detalle de un pago.
     */
    public function show($id)
    {
        // TODO: $pago = Pago::with(['contribuyente', 'deuda'])->findOrFail($id);
        return view('admin.pagos.show');
    }

    /**
     * Descarga el comprobante de pago (PDF).
     */
    public function comprobante($id)
    {
        // TODO: Generar PDF del comprobante de pago
        // TODO: Registrar en auditoría
        // return response()->download($pdfPath, "comprobante_{$id}.pdf");
    }
}
