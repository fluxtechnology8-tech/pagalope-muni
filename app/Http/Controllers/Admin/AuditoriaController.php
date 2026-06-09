<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    /**
     * Lista de registros de auditoría.
     */
    public function index(Request $request)
    {
        // TODO: Obtener registros de auditoría con usuario
        // TODO: Filtrar por módulo, acción, fecha
        // $auditoria = Auditoria::with('usuario')
        //     ->when($request->modulo, fn($q, $m) => $q->where('modulo', $m))
        //     ->when($request->accion, fn($q, $a) => $q->where('accion', $a))
        //     ->orderByDesc('created_at')
        //     ->paginate(20);

        return view('admin.auditoria.index');
    }

    /**
     * Muestra el detalle de un registro de auditoría.
     */
    public function show($id)
    {
        // TODO: $registro = Auditoria::with('usuario')->findOrFail($id);
        return view('admin.auditoria.show');
    }
}
