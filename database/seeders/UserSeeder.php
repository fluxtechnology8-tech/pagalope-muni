<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Contribuyente;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contribuyente
        $contribuyente = User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => Hash::make('password123'),
        ]);

        Contribuyente::create([
            'user_id' => $contribuyente->id,
        ]);

        // Administrador
        $administrador = User::create([
            'name' => 'María López',
            'email' => 'maria@example.com',
            'password' => Hash::make('password123'),
        ]);

        Administrador::create([
            'user_id' => $administrador->id,
        ]);

        // Usuario con ambos perfiles
        $ambos = User::create([
            'name' => 'Carlos Rodríguez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password123'),
        ]);

        Contribuyente::create([
            'user_id' => $ambos->id,
        ]);

        Administrador::create([
            'user_id' => $ambos->id,
        ]);
    }
}
