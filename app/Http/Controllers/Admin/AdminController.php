<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Login administrativo - muestra el formulario.
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Procesa el login administrativo.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // TODO: Implementar autenticación con Auth::attempt($credentials)
        // TODO: Verificar que el usuario tenga rol de administrador
        // TODO: Registrar intento de acceso en log_accesos

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended(route('admin.dashboard'));
        // }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }

    /**
     * Cierra la sesión administrativa.
     */
    public function logout(Request $request)
    {
        // TODO: Auth::logout();
        // TODO: Registrar cierre de sesión en log_accesos
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('portal.index');
    }
}
