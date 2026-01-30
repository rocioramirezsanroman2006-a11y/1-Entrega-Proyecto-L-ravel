<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidosSeeder extends Seeder
{
    public function run(): void
    {
        $pedidos = [
            [
                'numero_pedido' => 'PED-2026-001',
                'cliente_id' => 1,
                'fecha_pedido' => '2026-01-15',
                'fecha_entrega' => '2026-01-20',
                'estado' => 'completado',
                'total' => 1289.97,
                'descripcion' => 'Compra de laptop y monitor',
            ],
            [
                'numero_pedido' => 'PED-2026-002',
                'cliente_id' => 2,
                'fecha_pedido' => '2026-01-18',
                'fecha_entrega' => '2026-01-25',
                'estado' => 'pendiente',
                'total' => 309.97,
                'descripcion' => 'Accesorios gaming',
            ],
            [
                'numero_pedido' => 'PED-2026-003',
                'cliente_id' => 3,
                'fecha_pedido' => '2026-01-20',
                'fecha_entrega' => '2026-02-02',
                'estado' => 'en_proceso',
                'total' => 749.96,
                'descripcion' => 'Equipo completo para oficina',
            ],
            [
                'numero_pedido' => 'PED-2026-004',
                'cliente_id' => 4,
                'fecha_pedido' => '2026-01-22',
                'fecha_entrega' => '2026-02-05',
                'estado' => 'cancelado',
                'total' => 159.99,
                'descripcion' => 'Webcam 4K',
            ],
            [
                'numero_pedido' => 'PED-2026-005',
                'cliente_id' => 5,
                'fecha_pedido' => '2026-01-25',
                'fecha_entrega' => '2026-02-10',
                'estado' => 'en_proceso',
                'total' => 1569.96,
                'descripcion' => 'Pedido mayorista de componentes',
            ],
        ];

        foreach ($pedidos as $pedido) {
            Pedido::create($pedido);
        }
    }
}
