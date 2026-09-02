<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
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

        return view('admin.dashboard');
    }
}
