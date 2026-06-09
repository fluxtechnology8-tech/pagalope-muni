<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContribuyenteController extends Controller
{
    /**
     * Lista de contribuyentes.
     */
    public function index(Request $request)
    {
        // TODO: Obtener contribuyentes con paginación
        // TODO: Filtrar por búsqueda (DNI, nombre, dirección)
        // $contribuyentes = Contribuyente::query()
        //     ->when($request->search, fn($q, $s) => $q->where('nombre', 'like', "%{$s}%")->orWhere('num_doc', 'like', "%{$s}%"))
        //     ->paginate(15);

        return view('admin.contribuyentes.index');
    }

    /**
     * Formulario de creación de contribuyente.
     */
    public function create()
    {
        return view('admin.contribuyentes.create');
    }

    /**
     * Guarda un nuevo contribuyente.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_doc'  => 'required|in:dni,ruc',
            'num_doc'   => 'required|string|max:11|unique:contribuyentes,num_doc',
            'nombre'    => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono'  => 'nullable|string|max:20',
        ]);

        // TODO: Contribuyente::create($validated);

        return redirect()->route('admin.contribuyentes.index')->with('success', 'Contribuyente creado correctamente.');
    }

    /**
     * Muestra el detalle de un contribuyente.
     */
    public function show($id)
    {
        // TODO: Obtener contribuyente con sus deudas (pendientes y pagadas)
        // $contribuyente = Contribuyente::with(['deudas' => fn($q) => $q->orderByDesc('periodo')])->findOrFail($id);

        return view('admin.contribuyentes.show');
    }

    /**
     * Formulario de edición de contribuyente.
     */
    public function edit($id)
    {
        // TODO: $contribuyente = Contribuyente::findOrFail($id);
        return view('admin.contribuyentes.edit');
    }

    /**
     * Actualiza un contribuyente.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono'  => 'nullable|string|max:20',
        ]);

        // TODO: Contribuyente::findOrFail($id)->update($validated);

        return redirect()->route('admin.contribuyentes.index')->with('success', 'Contribuyente actualizado correctamente.');
    }

    /**
     * Elimina un contribuyente.
     */
    public function destroy($id)
    {
        // TODO: Contribuyente::findOrFail($id)->delete();

        return redirect()->route('admin.contribuyentes.index')->with('success', 'Contribuyente eliminado.');
    }
}
