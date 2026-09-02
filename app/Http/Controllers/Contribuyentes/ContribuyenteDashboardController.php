<?php

namespace App\Http\Controllers\Contribuyentes;

use App\Http\Controllers\Controller;

class ContribuyenteDashboardController extends Controller
{
    /**
     * Muestra el dashboard principal del panel administrativo.
     */
    public function index()
    {
        // TODO: Obtener estadísticas:
        //   - Recaudado hoy
        //   - Pagos procesados hoy
        //   - Nuevas consultas hoy
        //   - Deudas vencidas hoy
        //   - Actividad reciente (últimos 10 registros de auditoría)

        return view('contribuyentes.dashboard');
    }
}
