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
