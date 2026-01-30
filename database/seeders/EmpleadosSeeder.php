<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadosSeeder extends Seeder
{
    public function run(): void
    {
        $empleados = [
            [
                'nombre' => 'David Castillo',
                'email' => 'david.castillo@empresa.com',
                'telefono' => '612111222',
                'puesto' => 'Gerente General',
                'departamento' => 'Dirección',
                'fecha_contratacion' => '2020-01-15',
                'salario' => 3500.00,
            ],
            [
                'nombre' => 'Isabela Moreno',
                'email' => 'isabela.moreno@empresa.com',
                'telefono' => '634222333',
                'puesto' => 'Jefa de Ventas',
                'departamento' => 'Ventas',
                'fecha_contratacion' => '2021-03-20',
                'salario' => 2800.00,
            ],
            [
                'nombre' => 'Miguel Romero',
                'email' => 'miguel.romero@empresa.com',
                'telefono' => '656333444',
                'puesto' => 'Técnico de Sistemas',
                'departamento' => 'Informática',
                'fecha_contratacion' => '2019-07-10',
                'salario' => 2200.00,
            ],
            [
                'nombre' => 'Sofía López García',
                'email' => 'sofia.lopez@empresa.com',
                'telefono' => '678444555',
                'puesto' => 'Contable',
                'departamento' => 'Administración',
                'fecha_contratacion' => '2022-01-05',
                'salario' => 2000.00,
            ],
            [
                'nombre' => 'Alejandro Díaz',
                'email' => 'alejandro.diaz@empresa.com',
                'telefono' => '689555666',
                'puesto' => 'Comercial',
                'departamento' => 'Ventas',
                'fecha_contratacion' => '2023-02-15',
                'salario' => 1800.00,
            ],
        ];

        foreach ($empleados as $empleado) {
            Empleado::create($empleado);
        }
    }
}
