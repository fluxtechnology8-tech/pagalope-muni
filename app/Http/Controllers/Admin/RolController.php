<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Lista de roles.
     */
    public function index()
    {
        // TODO: Obtener roles con permisos y conteo de usuarios
        // $roles = Rol::withCount('usuarios')->with('permisos')->get();

        return view('admin.roles.index');
    }

    /**
     * Formulario de creación de rol.
     */
    public function create()
    {
        // TODO: Obtener módulos disponibles para asignar permisos
        return view('admin.roles.create');
    }

    /**
     * Guarda un nuevo rol.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100|unique:roles,nombre',
            'descripcion' => 'nullable|string|max:500',
            'permisos'    => 'nullable|array',
        ]);

        // TODO: Crear rol y sincronizar permisos
        // $rol = Rol::create($validated);
        // $rol->permisos()->sync($request->permisos ?? []);

        return redirect()->route('admin.roles.index')->with('success', 'Rol creado correctamente.');
    }

    /**
     * Formulario de edición de rol.
     */
    public function edit($id)
    {
        // TODO: $rol = Rol::with('permisos')->findOrFail($id);
        return view('admin.roles.edit');
    }

    /**
     * Actualiza un rol.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100|unique:roles,nombre,' . $id,
            'descripcion' => 'nullable|string|max:500',
            'permisos'    => 'nullable|array',
        ]);

        // TODO: $rol = Rol::findOrFail($id);
        // TODO: $rol->update($validated);
        // TODO: $rol->permisos()->sync($request->permisos ?? []);

        return redirect()->route('admin.roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Elimina un rol.
     */
    public function destroy($id)
    {
        // TODO: Verificar que no haya usuarios con este rol
        // TODO: Rol::findOrFail($id)->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado.');
    }
}
