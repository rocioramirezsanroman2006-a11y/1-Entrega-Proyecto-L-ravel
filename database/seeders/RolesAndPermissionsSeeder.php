<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Crear roles, permisos y asignarlos a usuarios.
     */
    public function run(): void
    {
        // Crear Roles
        $adminRole = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['description' => 'Administrador con acceso completo']
        );

        $userRole = Role::firstOrCreate(
            ['name' => 'Usuario'],
            ['description' => 'Usuario con acceso limitado (crear y editar)']
        );

        // Crear Permisos
        $permissions = [
            ['name' => 'crear', 'description' => 'Puede crear registros'],
            ['name' => 'editar', 'description' => 'Puede editar registros'],
            ['name' => 'ver', 'description' => 'Puede ver registros'],
            ['name' => 'eliminar', 'description' => 'Puede eliminar registros'],
        ];

        foreach ($permissions as $permData) {
            $perm = Permission::firstOrCreate(
                ['name' => $permData['name']],
                ['description' => $permData['description']]
            );

            // Admin tiene todos los permisos
            if (!$adminRole->permissions()->where('permission_id', $perm->id)->exists()) {
                $adminRole->permissions()->attach($perm->id);
            }

            // Usuario solo puede crear, editar y ver (NO eliminar)
            if ($perm->name !== 'eliminar') {
                if (!$userRole->permissions()->where('permission_id', $perm->id)->exists()) {
                    $userRole->permissions()->attach($perm->id);
                }
            }
        }

        // Asignar rol Admin al usuario administrador
        $admin = User::where('email', 'admin@example.com')->first();
        if ($admin && !$admin->roles()->where('role_id', $adminRole->id)->exists()) {
            $admin->roles()->attach($adminRole->id);
        }

        // Crear usuario con rol "Usuario" (si no existe)
        $usuario = User::firstOrCreate(
            ['email' => 'usuario@example.com'],
            [
                'name' => 'Usuario',
                'password' => bcrypt('password'),
            ]
        );

        if (!$usuario->roles()->where('role_id', $userRole->id)->exists()) {
            $usuario->roles()->attach($userRole->id);
        }

        $this->command->info('Roles y permisos creados correctamente.');
        $this->command->info('  Admin: admin@example.com / password');
        $this->command->info('  Usuario: usuario@example.com / password');
    }
}
