<?php

namespace Database\Seeders;

use App\Models\Clientes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nombre' => 'Juan García López',
                'email' => 'juan.garcia@email.com',
                'telefono' => '612345678',
                'direccion' => 'Calle Principal 123, Madrid',
                'ciudad' => 'Madrid',
                'codigo_postal' => '28001',
                'empresa' => 'Tech Solutions S.L.',
            ],
            [
                'nombre' => 'María Rodríguez Martín',
                'email' => 'maria.rodriguez@email.com',
                'telefono' => '687654321',
                'direccion' => 'Av. de la República 456, Barcelona',
                'ciudad' => 'Barcelona',
                'codigo_postal' => '08002',
                'empresa' => 'Digital Marketing Inc.',
            ],
            [
                'nombre' => 'Carlos Fernández López',
                'email' => 'carlos.fernandez@email.com',
                'telefono' => '633456789',
                'direccion' => 'Plaza del Centro 789, Valencia',
                'ciudad' => 'Valencia',
                'codigo_postal' => '46001',
                'empresa' => 'Logística Express',
            ],
            [
                'nombre' => 'Ana Martínez González',
                'email' => 'ana.martinez@email.com',
                'telefono' => '645678901',
                'direccion' => 'Paseo Marítimo 321, Málaga',
                'ciudad' => 'Málaga',
                'codigo_postal' => '29001',
                'empresa' => 'Consultores Empresariales',
            ],
            [
                'nombre' => 'Pedro Sánchez Ruiz',
                'email' => 'pedro.sanchez@email.com',
                'telefono' => '667890123',
                'direccion' => 'Calle del Comercio 654, Sevilla',
                'ciudad' => 'Sevilla',
                'codigo_postal' => '41001',
                'empresa' => 'Importaciones Hispánicas',
            ],
        ];

        foreach ($clientes as $cliente) {
            Clientes::create($cliente);
        }
    }
}
