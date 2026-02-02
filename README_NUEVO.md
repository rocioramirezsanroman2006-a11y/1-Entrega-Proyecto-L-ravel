# TechPink Hub - CRM Empresarial

## ¿Qué es esto?

Es una aplicación web para gestionar cosas de una empresa. Básicamente puedes hacer CRUD de 5 cosas: clientes, productos, empleados, categorías y pedidos.

Lo hice con Laravel porque es el framework que tocaba. La interfaz es con AdminLTE y le cambié los colores a rosa pastel porque quedaba bien.

Tiene login, así que tienes que identificarte para entrar. Después de eso ves un dashboard que te muestra cuántos clientes, productos, empleados y pedidos tienes. Desde ahí puedes ir a cada módulo.

Cada módulo es igual: una tabla que te muestra todos los registros, y botones para crear, editar o eliminar. Nada complicado.

La base de datos tiene 5 tablas principales (clientes, productos, empleados, categorías, pedidos) y otras que Laravel crea por defecto. Los productos están relacionados con categorías, y los pedidos con clientes.

Viene con datos de prueba ya metidos, así que cuando abras la app ya ves 5 clientes, 8 productos, 5 empleados, etc.

---

## ¿Qué necesito?

- PHP 8.1+
- MySQL
- Composer

Si tienes XAMPP ya instalado, listo. Si no, descárgalo de aquí: https://www.apachefriends.org/

## Instalación

### Paso 1: Bajar el proyecto

```bash
git clone https://github.com/tu-usuario/nombre_proyecto.git
cd nombre_proyecto
```

### Paso 2: Instalar dependencias

```bash
composer install
```

### Paso 3: Configurar .env

```bash
copy .env.example .env
```

Edita el .env y deja la base de datos así:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=nombre_proyecto
DB_USERNAME=root
DB_PASSWORD=
```

### Paso 4: Generar clave

```bash
php artisan key:generate
```

### Paso 5: Crear la base de datos

```bash
mysql -u root -e "CREATE DATABASE nombre_proyecto;"
```

### Paso 6: Migraciones y datos

```bash
php artisan migrate:fresh --seed
```

### Paso 7: Ejecutar

```bash
php artisan serve
```

Abre http://localhost:8000

## Cómo entrar

Email: admin@example.com
Contraseña: password

## Dentro de la app

### Inicio

Cuando entras ves un resumen: cuántos clientes, cuántos productos, cuántos empleados, cuántos pedidos.

### Menú

En la izquierda está el menú con acceso a:
- Clientes
- Productos
- Empleados
- Categorías
- Pedidos

### Cada módulo

Todos funcionan igual. Ves una tabla, botones para ver/editar/eliminar, y un botón para crear nuevos.

**Clientes:** nombre, email, teléfono, dirección, empresa

**Productos:** nombre, precio en euros, stock, categoría

**Empleados:** nombre, email, puesto, departamento, salario en euros, fecha contratación

**Categorías:** nombre y descripción

**Pedidos:** número, cliente, fecha, total en euros, estado

## Datos que ya están

- 5 clientes
- 8 productos
- 5 empleados
- 4 categorías
- 5 pedidos

## Colores

Le puse colores diferentes a cada módulo:
- Azul para clientes
- Verde para productos
- Púrpura para empleados
- Amarillo para categorías
- Rosa para pedidos

Todo en pastel, nada agresivo.

## Base de datos

Está en database_backup.sql por si la necesitas.

Las tablas principales están relacionadas: los productos pertenecen a una categoría, y los pedidos son de un cliente.

## Comandos útiles

Resetear todo:
```bash
php artisan migrate:fresh --seed
```

Limpiar caché:
```bash
php artisan cache:clear
```

Si el puerto 8000 está ocupado:
```bash
php artisan serve --port=8080
```

## Estructura

```
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
└── routes/
```

## Si algo no funciona

**La base de datos no existe:**
```bash
mysql -u root -e "CREATE DATABASE nombre_proyecto;"
```

**El puerto 8000 está ocupado:**
```bash
php artisan serve --port=8080
```

**Permisos en Linux:**
```bash
chmod -R 755 storage/ bootstrap/cache/
```

## Tecnologías

- Laravel 12
- AdminLTE 3
- Bootstrap 5
- MySQL
- Blade

## Eso es todo

Es un CRM simple. Entras, ves datos, puedes crear/editar/eliminar. Sin complicaciones.
