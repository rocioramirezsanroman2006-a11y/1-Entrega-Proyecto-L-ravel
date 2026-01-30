<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Ejecutar seeders en orden
        $this->call([
            CategoriasSeeder::class,
            ClientesSeeder::class,
            EmpleadosSeeder::class,
            ProductosSeederData::class,
            PedidosSeeder::class,
        ]);

        \Log::info('Base de datos poblada correctamente');
    }
}
