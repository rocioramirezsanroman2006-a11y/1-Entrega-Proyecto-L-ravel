<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Computadoras',
                'descripcion' => 'Laptops, PCs de escritorio y tablets',
            ],
            [
                'nombre' => 'Periféricos',
                'descripcion' => 'Accesorios y dispositivos periféricos',
            ],
            [
                'nombre' => 'Cables y Adaptadores',
                'descripcion' => 'Cables, adaptadores y conectores variados',
            ],
            [
                'nombre' => 'Software',
                'descripcion' => 'Licencias de software y aplicaciones',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
