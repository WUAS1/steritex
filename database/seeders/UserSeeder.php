<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Administrador
        User::updateOrCreate(
            ['email' => 'admin@steritex.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'rol' => 'administrador',
            ]
        );

        // Usuario Operador
        User::updateOrCreate(
            ['email' => 'operador@steritex.com'],
            [
                'name' => 'Operador',
                'password' => Hash::make('operador123'),
                'rol' => 'operador',
            ]
        );

        $this->command->info('Usuarios creados exitosamente!');
        $this->command->info('Admin: admin@steritex.com / admin123');
        $this->command->info('Operador: operador@steritex.com / operador123');
    }
}

