<?php

namespace Database\Seeders;

use App\Models\Productos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosSeederData extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'Laptop Dell Inspiron 15',
                'descripcion' => 'Portátil 15 pulgadas con procesador Intel i7 de última generación',
                'precio' => 899.99,
                'stock' => 25,
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Monitor LG 27"',
                'descripcion' => 'Monitor 4K con tecnología IPS y soporte ajustable',
                'precio' => 349.99,
                'stock' => 45,
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Teclado Mecánico RGB',
                'descripcion' => 'Teclado mecánico con switches cherry y iluminación RGB',
                'precio' => 129.99,
                'stock' => 60,
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Mouse Logitech Pro',
                'descripcion' => 'Ratón inalámbrico con precisión de 16000 DPI',
                'precio' => 89.99,
                'stock' => 80,
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Headset Gaming HyperX',
                'descripcion' => 'Auriculares gaming con sonido 7.1 y micrófono incorporado',
                'precio' => 179.99,
                'stock' => 35,
                'categoria_id' => 2,
            ],
            [
                'nombre' => 'Webcam Logitech 4K',
                'descripcion' => 'Cámara web 4K con enfoque automático y corrección de luz',
                'precio' => 159.99,
                'stock' => 20,
                'categoria_id' => 2,
            ],
            [
                'nombre' => 'Cable HDMI 2.1',
                'descripcion' => 'Cable HDMI 2.1 de 2 metros para 8K 60Hz',
                'precio' => 24.99,
                'stock' => 150,
                'categoria_id' => 3,
            ],
            [
                'nombre' => 'Adaptador USB-C Thunderbolt',
                'descripcion' => 'Adaptador Thunderbolt 3 para conectar periféricos',
                'precio' => 49.99,
                'stock' => 40,
                'categoria_id' => 3,
            ],
        ];

        foreach ($productos as $producto) {
            Productos::create($producto);
        }
    }
}
