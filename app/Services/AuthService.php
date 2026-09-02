<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function loginAsContribuyente(
        string $email,
        string $password
    ): void {
        $user = User::where('email', $email)->first();

        if (
            !$user ||
            !Hash::check($password, $user->password)
        ) {
            throw ValidationException::withMessages([
                'email' => 'Las credenciales son incorrectas.',
            ]);
        }

        if (!$user->contribuyente()->exists()) {
            throw ValidationException::withMessages([
                'email' => 'El usuario no tiene perfil de contribuyente.',
            ]);
        }

        Auth::login($user);

        session([
            'auth_profile' => 'contribuyente',
        ]);
    }

    public function loginAsAdministrador(
        string $email,
        string $password
    ): void {
        $user = User::where('email', $email)->first();

        if (
            !$user ||
            !Hash::check($password, $user->password)
        ) {
            throw ValidationException::withMessages([
                'email' => 'Las credenciales son incorrectas.',
            ]);
        }

        if (!$user->administrador()->exists()) {
            throw ValidationException::withMessages([
                'email' => 'El usuario no tiene perfil de administrador.',
            ]);
        }

        Auth::login($user);

        session([
            'auth_profile' => 'administrador',
        ]);
    }
}