<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeudaController extends Controller
{
    /**
     * Lista de deudas.
     */
    public function index(Request $request)
    {
        // TODO: Obtener deudas con relación a contribuyente
        // TODO: Filtrar por estado (pendiente, vencida, pagada)
        // TODO: Filtrar por contribuyente
        // $deudas = Deuda::with('contribuyente')
        //     ->when($request->estado, fn($q, $e) => $q->where('estado', $e))
        //     ->paginate(15);

        return view('admin.deudas.index');
    }

    /**
     * Formulario de creación de deuda.
     */
    public function create()
    {
        // TODO: Obtener lista de contribuyentes para el select
        return view('admin.deudas.create');
    }

    /**
     * Guarda una nueva deuda.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contribuyente_id' => 'required|exists:contribuyentes,id',
            'concepto'         => 'required|string|max:255',
            'periodo'          => 'required|string|max:7',
            'monto'            => 'required|numeric|min:0',
            'estado'           => 'required|in:pendiente,vencida,pagada',
        ]);

        // TODO: Deuda::create($validated);

        return redirect()->route('admin.deudas.index')->with('success', 'Deuda creada correctamente.');
    }

    /**
     * Muestra el detalle de una deuda.
     */
    public function show($id)
    {
        // TODO: $deuda = Deuda::with('contribuyente')->findOrFail($id);
        return view('admin.deudas.show');
    }

    /**
     * Formulario de edición de deuda.
     */
    public function edit($id)
    {
        // TODO: $deuda = Deuda::findOrFail($id);
        return view('admin.deudas.edit');
    }

    /**
     * Actualiza una deuda.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'concepto' => 'required|string|max:255',
            'periodo'  => 'required|string|max:7',
            'monto'    => 'required|numeric|min:0',
            'estado'   => 'required|in:pendiente,vencida,pagada',
        ]);

        // TODO: Deuda::findOrFail($id)->update($validated);

        return redirect()->route('admin.deudas.index')->with('success', 'Deuda actualizada correctamente.');
    }

    /**
     * Elimina una deuda.
     */
    public function destroy($id)
    {
        // TODO: Deuda::findOrFail($id)->delete();

        return redirect()->route('admin.deudas.index')->with('success', 'Deuda eliminada.');
    }
}
