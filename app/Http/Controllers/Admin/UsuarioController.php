<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Lista de usuarios administrativos.
     */
    public function index(Request $request)
    {
        // TODO: Obtener usuarios con rol
        // TODO: Filtrar por nombre, email
        // $usuarios = User::with('rol')
        //     ->when($request->search, fn($q, $s) => $q->where('name', 'like', "%{$s}%")->orWhere('email', 'like', "%{$s}%"))
        //     ->paginate(15);

        return view('admin.usuarios.index');
    }

    /**
     * Formulario de creación de usuario.
     */
    public function create()
    {
        // TODO: Obtener roles disponibles
        return view('admin.usuarios.create');
    }

    /**
     * Guarda un nuevo usuario administrativo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        // TODO: $validated['password'] = Hash::make($validated['password']);
        // TODO: User::create($validated);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Formulario de edición de usuario.
     */
    public function edit($id)
    {
        // TODO: $usuario = User::findOrFail($id);
        // TODO: Obtener roles disponibles
        return view('admin.usuarios.edit');
    }

    /**
     * Actualiza un usuario administrativo.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        // TODO: $usuario = User::findOrFail($id);
        // TODO: if ($validated['password']) $validated['password'] = Hash::make($validated['password']);
        //       else unset($validated['password']);
        // TODO: $usuario->update($validated);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario administrativo.
     */
    public function destroy($id)
    {
        // TODO: User::findOrFail($id)->delete();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado.');
    }
}
