<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create([
            'name' => 'Admin',
            'description' => 'Administrador del sistema',
        ]);

        $userRole = Role::create([
            'name' => 'Usuario',
            'description' => 'Usuario regular',
        ]);

        // Crear permisos
        $permissions = [
            ['name' => 'crear_cliente', 'description' => 'Crear clientes'],
            ['name' => 'editar_cliente', 'description' => 'Editar clientes'],
            ['name' => 'eliminar_cliente', 'description' => 'Eliminar clientes'],
            ['name' => 'crear_producto', 'description' => 'Crear productos'],
            ['name' => 'editar_producto', 'description' => 'Editar productos'],
            ['name' => 'eliminar_producto', 'description' => 'Eliminar productos'],
            ['name' => 'crear_empleado', 'description' => 'Crear empleados'],
            ['name' => 'editar_empleado', 'description' => 'Editar empleados'],
            ['name' => 'eliminar_empleado', 'description' => 'Eliminar empleados'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Admin tiene todos los permisos
        $adminRole->permissions()->sync(Permission::all());

        // Usuario solo puede crear y editar
        $userRole->permissions()->sync(
            Permission::whereIn('name', [
                'crear_cliente', 'editar_cliente',
                'crear_producto', 'editar_producto',
                'crear_empleado', 'editar_empleado',
            ])->pluck('id')
        );

        // Asignar rol admin al usuario actual
        $user = User::first();
        if ($user) {
            $user->roles()->attach($adminRole);
        }
    }
}
