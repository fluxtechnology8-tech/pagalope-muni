<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {
    }

    public function showLoginContribuyente()
    {
        return view('contribuyentes.login');
    }

    public function loginContribuyente(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $this->authService->loginAsContribuyente(
            $credentials['email'],
            $credentials['password']
        );

        return redirect()->route('contribuyentes.dashboard');
    }

    public function showLoginAdministrador()
    {
        return view('admin.login');
    }

    public function loginAdministrador(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $this->authService->loginAsAdministrador(
            $credentials['email'],
            $credentials['password']
        );

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('portal.index');
    }
}