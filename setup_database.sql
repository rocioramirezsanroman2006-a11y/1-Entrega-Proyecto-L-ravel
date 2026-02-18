+-- Crear tabla roles
CREATE TABLE IF NOT EXISTS roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    description VARCHAR(255),
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla permissions
CREATE TABLE IF NOT EXISTS permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    description VARCHAR(255),
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla role_user
CREATE TABLE IF NOT EXISTS role_user (
    role_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (role_id, user_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Crear tabla permission_role
CREATE TABLE IF NOT EXISTS permission_role (
    permission_id BIGINT UNSIGNED NOT NULL,
    role_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (permission_id, role_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

-- Las columnas de clientes y productos ya fueron agregadas previamente

-- Insertar roles
INSERT IGNORE INTO roles (id, name, description, created_at, updated_at) VALUES 
(1, 'Admin', 'Administrador del sistema', NOW(), NOW()),
(2, 'Usuario', 'Usuario regular', NOW(), NOW());

-- Insertar permisos
INSERT IGNORE INTO permissions (name, description, created_at, updated_at) VALUES
('crear_cliente', 'Crear clientes', NOW(), NOW()),
('editar_cliente', 'Editar clientes', NOW(), NOW()),
('eliminar_cliente', 'Eliminar clientes', NOW(), NOW()),
('crear_producto', 'Crear productos', NOW(), NOW()),
('editar_producto', 'Editar productos', NOW(), NOW()),
('eliminar_producto', 'Eliminar productos', NOW(), NOW()),
('crear_empleado', 'Crear empleados', NOW(), NOW()),
('editar_empleado', 'Editar empleados', NOW(), NOW()),
('eliminar_empleado', 'Eliminar empleados', NOW(), NOW());

-- Asignar TODOS los permisos al rol Admin
INSERT IGNORE INTO permission_role (permission_id, role_id)
SELECT p.id, 1 FROM permissions p;

-- Asignar solo crear/editar al rol Usuario (sin eliminar)
INSERT IGNORE INTO permission_role (permission_id, role_id)
SELECT p.id, 2 FROM permissions p 
WHERE p.name IN ('crear_cliente', 'editar_cliente', 'crear_producto', 'editar_producto', 'crear_empleado', 'editar_empleado');

-- Asignar rol Admin al usuario admin@example.com
INSERT IGNORE INTO role_user (role_id, user_id)
SELECT 1, u.id FROM users u WHERE u.email = 'admin@example.com' AND NOT EXISTS (SELECT 1 FROM role_user ru WHERE ru.user_id = u.id);

-- Actualizar migration table para marcar migraciones como completadas
INSERT IGNORE INTO migrations (migration, batch) VALUES
('2026_02_16_000000_create_roles_and_permissions_table', 1),
('2026_02_16_000001_add_images_and_files_to_tables', 1);
