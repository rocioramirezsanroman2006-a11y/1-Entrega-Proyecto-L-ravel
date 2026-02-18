# TechPink Hub

Un CRM para gestionar clientes, productos, empleados, categorías y pedidos. Lo hice con Laravel para la clase.

## ¿Qué es?

Es una aplicación web donde puedes hacer CRUD de 5 cosas:
- Clientes (nombre, email, teléfono, dirección, etc)
- Productos (nombre, precio, stock, categoría)
- Empleados (nombre, puesto, salario, departamento)
- Categorías (para clasificar productos)
- Pedidos (de clientes, con total y estado)

Tiene login, así que tienes que entrar con email y contraseña. Una vez dentro ves un panel con números de cuántos registros hay de cada cosa. Desde ahí puedes ir a cualquier módulo y crear, editar o eliminar registros.

Nada complicado. Es un CRUD básico pero completo.

La interfaz es rosa pastel porque quedaba mejor que los colores por defecto.

## Requisitos

- PHP 8.1 o superior
- MySQL
- Composer

La forma más fácil es descargar XAMPP que trae todo: https://www.apachefriends.org/

## Cómo instalar

### 1. Descargar el proyecto

```bash
git clone https://github.com/tu-usuario/nombre_proyecto.git
cd nombre_proyecto
```

O si ya lo tienes:
```bash
cd C:\xampp\htdocs\test\nombre_proyecto
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar .env

```bash
copy .env.example .env
```

Edita el archivo y cambia esto si es necesario:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=nombre_proyecto
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generar clave

```bash
php artisan key:generate
```

### 5. Crear base de datos

```bash
mysql -u root -e "CREATE DATABASE nombre_proyecto;"
```

### 6. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

### 7. Iniciar servidor

```bash
php artisan serve
```

Luego abre: http://localhost:8000

## Login

Email: admin@example.com
Contraseña: password

## Datos de prueba

Ya viene cargado:
- 5 clientes
- 8 productos
- 4 categorías
- 5 empleados
- 5 pedidos

No necesitas crear nada si no quieres, solo prueba los que ya están.

## Las pantallas

### Dashboard
Cuando entras ves un resumen:
- Total de clientes
- Total de empleados
- Total de productos
- Total de pedidos

Con un botón en cada uno para ir al módulo.

### Clientes
Una tabla con todos los clientes. Puedes crear nuevo, editar o eliminar.

### Productos
Una tabla con los productos. Tienes que asignarles una categoría y un precio.

### Empleados
Los empleados con su salario, puesto y departamento.

### Categorías
Solo nombre y descripción. Para agrupar productos.

### Pedidos
Los pedidos de clientes con fecha, total y estado (pendiente, en proceso, completado, cancelado).

## Base de datos

Las tablas principales son:
- users (para login)
- clientes
- productos
- empleados
- categorias
- pedidos

Los productos pertenecen a categorías. Los pedidos son de clientes.

También hay un backup en database_backup.sql si la cagas.

## Problemas comunes

**La base de datos no existe:**
```bash
mysql -u root -e "CREATE DATABASE nombre_proyecto;"
php artisan migrate:fresh --seed
```

**El puerto 8000 está ocupado:**
```bash
php artisan serve --port=8080
```

**Error de permisos (Linux/Mac):**
```bash
chmod -R 755 storage/ bootstrap/cache/
```

## Segunda Entrega - Nuevas Funcionalidades

### ✨ Características Implementadas

#### 1. Sistema de Roles y Permisos

El sistema ahora distingue entre dos tipos de usuarios:

- **Admin**: Puede crear, editar, y **eliminar** registros
- **Usuario Regular**: Puede crear y editar, pero **no puede eliminar**

Los botones de eliminar se muestran/ocultan automáticamente según el rol del usuario logeado.

**Cómo funciona:**
```php
@if(auth()->user()->isAdmin())
    <!-- Mostrar botón de eliminar -->
@endif
```

#### 2. Subida de Archivos e Imágenes

Los módulos de Clientes y Productos ahora soportan archivos:

**Clientes:**
- Foto de perfil (JPEG, PNG, JPG, GIF - máx. 2MB)
- Se guarda en `public/storage/clientes/`

**Productos:**
- Imagen del producto (JPEG, PNG, JPG, GIF - máx. 2MB)
- PDF con información adicional (máx. 5MB)
- Se guardan en `public/storage/productos/`

En los formularios de crear/editar verás campos de archivo con vista previa de los archivos actuales.

**Primero, ejecuta esto para crear el enlace al almacenamiento:**
```bash
php run_migrations.php
# O manualmente en Windows:
mklink /J public\storage storage\app\public
```

#### 3. Paginación

Todas las vistas de índice ahora muestran 15 registros por página en lugar de todos:

- Clientes: 15 por página
- Productos: 15 por página
- Empleados: 15 por página
- Categorías: 15 por página
- Pedidos: 15 por página

Al final de cada tabla verás los números de página para navegar.

#### 4. Control de Acceso en Vistas

Los botones de acción ahora respetan el rol del usuario:

- **Botones Ver y Editar**: Visibles para todos (Admin y Usuario Regular)
- **Botón Eliminar**: Solo para Admin

#### 5. Modelos y Migraciones

Se han creado nuevas tablas en la base de datos:

- **roles**: Tabla para almacenar roles (Admin, Usuario)
- **permissions**: Tabla para almacenar permisos
- **role_user**: Tabla pivote para asignar roles a usuarios
- **permission_role**: Tabla pivote para asignar permisos a roles

Se han agregado columnas a tablas existentes:
- **clientes.foto**: Para almacenar la ruta de la foto
- **productos.imagen**: Para almacenar la ruta de la imagen
- **productos.archivo_pdf**: Para almacenar la ruta del PDF

### 🚀 próximos Pasos (Futuras Mejoras)

- DataTables con búsqueda avanzada y ordenamiento
- Exportar datos a Excel/PDF
- Gráficos y reportes estadísticos
- Panel de administrador con más opciones
- Historial de cambios

## Comandos útiles

Resetear todo (borra datos):
```bash
php artisan migrate:fresh --seed
```

Limpiar caché:
```bash
php artisan cache:clear
```

## Tecnologías

- Laravel
- MySQL
- AdminLTE
- Bootstrap

Eso es todo. La aplicación funciona, los CRUDs están listos y ya puedes empezar a usarla.
