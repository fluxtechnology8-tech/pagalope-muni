<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    /**
     * Lista de módulos del sistema.
     */
    public function index()
    {
        // TODO: Obtener módulos con roles asignados
        // $modulos = Modulo::with('roles')->get();

        return view('admin.modulos.index');
    }

    /**
     * Formulario de creación de módulo.
     */
    public function create()
    {
        return view('admin.modulos.create');
    }

    /**
     * Guarda un nuevo módulo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'ruta'        => 'required|string|max:255|unique:modulos,ruta',
            'descripcion' => 'nullable|string|max:500',
        ]);

        // TODO: Modulo::create($validated);

        return redirect()->route('admin.modulos.index')->with('success', 'Módulo creado correctamente.');
    }

    /**
     * Formulario de edición de módulo.
     */
    public function edit($id)
    {
        // TODO: $modulo = Modulo::findOrFail($id);
        return view('admin.modulos.edit');
    }

    /**
     * Actualiza un módulo.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'ruta'        => 'required|string|max:255|unique:modulos,ruta,' . $id,
            'descripcion' => 'nullable|string|max:500',
        ]);

        // TODO: Modulo::findOrFail($id)->update($validated);

        return redirect()->route('admin.modulos.index')->with('success', 'Módulo actualizado correctamente.');
    }

    /**
     * Elimina un módulo.
     */
    public function destroy($id)
    {
        // TODO: Modulo::findOrFail($id)->delete();

        return redirect()->route('admin.modulos.index')->with('success', 'Módulo eliminado.');
    }

    /**
     * Activa/desactiva un módulo.
     */
    public function toggle($id)
    {
        // TODO: $modulo = Modulo::findOrFail($id);
        // TODO: $modulo->update(['activo' => !$modulo->activo]);

        return redirect()->route('admin.modulos.index')->with('success', 'Estado del módulo actualizado.');
    }
}
