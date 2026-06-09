<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Panel de reportes disponibles.
     */
    public function index()
    {
        // TODO: Listar reportes disponibles según permisos del usuario
        return view('admin.reportes.index');
    }

    /**
     * Genera el reporte de recaudación mensual.
     */
    public function recaudacionMensual(Request $request)
    {
        // TODO: Validar fecha inicio y fin
        // TODO: Consultar pagos en el rango y agrupar por día/concepto
        // TODO: Generar PDF o retornar JSON para gráfico
    }

    /**
     * Genera el reporte de deudas por vencer.
     */
    public function deudasPorVencer()
    {
        // TODO: Consultar deudas con estado pendiente que vencen en los próximos 30 días
    }

    /**
     * Genera el reporte de contribuyentes con deuda.
     */
    public function contribuyentesConDeuda()
    {
        // TODO: Consultar contribuyentes que tengan al menos 1 deuda pendiente
    }
}
