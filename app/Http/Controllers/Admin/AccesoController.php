<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccesoController extends Controller
{
    /**
     * Lista de logs de acceso.
     */
    public function index(Request $request)
    {
        // TODO: Obtener logs de acceso (intentos de login)
        // TODO: Filtrar por usuario, estado (exitoso/fallido), fecha
        // $accesos = LogAcceso::with('usuario')
        //     ->when($request->estado, fn($q, $e) => $q->where('estado', $e))
        //     ->orderByDesc('created_at')
        //     ->paginate(20);

        return view('admin.accesos.index');
    }

    /**
     * Registra un intento de acceso.
     * Método estático para ser llamado desde AuthController.
     */
    public static function registrar($email, $ip, $userAgent, $exitoso, $mensaje = null)
    {
        // TODO: LogAcceso::create([
        //     'email'     => $email,
        //     'ip'        => $ip,
        //     'user_agent' => $userAgent,
        //     'exitoso'   => $exitoso,
        //     'mensaje'   => $mensaje,
        //     'usuario_id' => $exitoso ? auth()->id() : null,
        // ]);
    }
}
