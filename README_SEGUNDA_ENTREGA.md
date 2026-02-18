# Segunda Entrega – CRM en Laravel

**Proyecto**: TechPink Hub – CRM de Gestión Empresarial  
**Fecha**: 18 de Febrero de 2026  
**Framework**: Laravel 12 + AdminLTE 3

---

## Índice

1. [Descripción general](#descripción-general)
2. [Uso de plugins externos (DataTables)](#1-uso-de-plugins-externos-datatables)
3. [Paginación en los listados](#2-paginación-en-los-listados)
4. [Subida de imágenes](#3-subida-de-imágenes)
5. [Subida y gestión de archivos PDF](#4-subida-y-gestión-de-archivos-pdf)
6. [Creación y uso de Roles](#5-creación-y-uso-de-roles-admin-usuario)
7. [Control de permisos en vistas](#6-control-de-permisos-en-vistas)
8. [Base de datos – Migraciones añadidas](#base-de-datos--migraciones-añadidas)
9. [Archivos modificados y creados](#archivos-modificados-y-creados)
10. [Cómo instalar y probar](#cómo-instalar-y-probar)
11. [Usuarios de prueba](#usuarios-de-prueba)

---

## Descripción general

En la primera entrega se creó un CRM básico con Laravel: estructura del proyecto, modelos, migraciones y CRUD simple para Clientes, Productos, Empleados, Categorías y Pedidos.

En esta segunda entrega se amplía el proyecto incorporando:

| Funcionalidad | Estado |
|---|---|
| Uso de plugins externos (DataTables) | ✅ Implementado |
| Paginación al mostrar datos en el index | ✅ Implementado |
| Subida de imágenes (foto cliente, imagen producto) | ✅ Implementado |
| Subida y gestión de archivos (PDF del producto) | ✅ Implementado |
| Creación y uso de Roles (Admin, Usuario) | ✅ Implementado |
| Control de permisos en vistas | ✅ Implementado |

---

## 1. Uso de plugins externos (DataTables)

### ¿Qué es?

DataTables es un plugin de jQuery que convierte tablas HTML normales en tablas interactivas con búsqueda, ordenación por columnas y diseño responsive. Se carga desde CDN, sin necesidad de instalar nada con npm.

### Configuración

El plugin se activa en `config/adminlte.php` dentro del array `plugins`:

```php
'Datatables' => [
    'active' => true,
    'files' => [
        ['type' => 'js',  'asset' => false, 'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'],
        ['type' => 'js',  'asset' => false, 'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'],
        ['type' => 'css', 'asset' => false, 'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'],
    ],
],
```

### Uso en las vistas

En cada vista `index.blade.php` se inicializa DataTables con idioma en español:

```javascript
$(function() {
    $('#tableclientes').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        "paging": false,   // La paginación la hace Laravel
        "info": false,      // No mostrar "Mostrando X de Y" de DataTables
        "responsive": true
    });
});
```

### Funcionalidades que aporta DataTables

- **Búsqueda en tiempo real**: campo de texto que filtra todas las columnas al escribir
- **Ordenación por columnas**: clic en cualquier cabecera para ordenar ascendente/descendente
- **Responsive**: la tabla se adapta a pantallas pequeñas

### Vistas que lo usan

| Vista | ID de la tabla |
|---|---|
| `clientes/index.blade.php` | `#tableclientes` |
| `productos/index.blade.php` | `#tablaproductos` |
| `empleados/index.blade.php` | `#tablaemp` |
| `categorias/index.blade.php` | `#tablacat` |
| `pedidos/index.blade.php` | `#tblped` |

---

## 2. Paginación en los listados

### ¿Cómo funciona?

En lugar de cargar todos los registros con `Model::all()`, los controllers ahora usan `Model::paginate(10)` para traer solo 10 registros por página.

### Cambios en controllers

```php
// ANTES (primera entrega)
$clientes = Clientes::all();

// AHORA (segunda entrega)
$clientes = Clientes::paginate(10);
```

Esto se aplica a los 5 controllers:

| Controller | Método `index()` |
|---|---|
| `ClientesController` | `Clientes::paginate(10)` |
| `ProductoController` | `Productos::with('categoria')->paginate(10)` |
| `EmpleadoController` | `Empleado::paginate(10)` |
| `CategoriaController` | `Categoria::paginate(10)` |
| `PedidoController` | `Pedido::with('cliente')->paginate(10)` |

### Cambios en vistas

Al final de cada tabla se muestran los enlaces de paginación de Laravel:

```blade
<div class="card-footer">
    {{ $clientes->links() }}
</div>
```

### Estilo Bootstrap

Para que los enlaces de paginación tengan el estilo de Bootstrap (compatible con AdminLTE), se configuró en `AppServiceProvider`:

```php
use Illuminate\Pagination\Paginator;

public function boot(): void
{
    Paginator::useBootstrapFive();
}
```

### Convivencia con DataTables

DataTables tiene su propia paginación interna, pero como la paginación real viene de Laravel (solo llegan 10 registros del servidor), se desactiva la de DataTables con `"paging": false` y `"info": false`. De esta manera:

- **DataTables** → se encarga de la búsqueda y la ordenación de la página actual
- **Laravel** → se encarga de la paginación real (traer 10 registros del servidor)

---

## 3. Subida de imágenes

### Clientes – Foto de perfil

Los clientes pueden tener una foto asociada. El campo `foto` se añadió a la tabla `clientes` mediante la migración `2026_02_16_000001_add_images_and_files_to_tables.php`.

**Formularios** (`create.blade.php` y `edit.blade.php`):
```html
<form ... enctype="multipart/form-data">
    <input type="file" name="foto" accept="image/*">
</form>
```

**Validación** (en `ClientesController`):
```php
'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```

**Almacenamiento** (en `ClientesController@store`):
```php
if ($request->hasFile('foto')) {
    $path = $request->file('foto')->store('clientes', 'public');
    $validated['foto'] = $path;
}
```

Las fotos se guardan en `storage/app/public/clientes/` y son accesibles desde `public/storage/clientes/` gracias al symlink.

**Visualización** en la tabla del index:
```blade
@if($cliente->foto)
    <img src="{{ asset('storage/' . $cliente->foto) }}" style="width: 40px; height: 40px; border-radius: 50%;">
@else
    <span class="badge badge-secondary"><i class="fas fa-user"></i></span>
@endif
```

En la vista `show.blade.php` se muestra la foto a tamaño grande. En `edit.blade.php` se muestra una vista previa de la foto actual.

### Productos – Imagen del producto

Funciona igual que la foto de clientes pero para productos:

- Campo: `imagen`
- Almacenamiento: `storage/app/public/productos/imagenes/`
- Validación: `'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'`

**Reemplazo de imágenes**: cuando se sube una nueva imagen al editar, el controller borra la anterior:

```php
if ($request->hasFile('imagen')) {
    if ($producto->imagen) {
        Storage::disk('public')->delete($producto->imagen);
    }
    $validated['imagen'] = $request->file('imagen')->store('productos/imagenes', 'public');
}
```

---

## 4. Subida y gestión de archivos PDF

### Productos – Documento PDF

Cada producto puede tener un archivo PDF asociado (ficha técnica, catálogo, etc.).

**Validación**:
```php
'archivo_pdf' => 'nullable|mimes:pdf|max:5120',  // máximo 5MB
```

**Almacenamiento**: `storage/app/public/productos/pdfs/`

**Visualización en la tabla index**: un botón con icono de PDF que abre el archivo en nueva pestaña:
```blade
@if($producto->archivo_pdf)
    <a href="{{ asset('storage/' . $producto->archivo_pdf) }}" target="_blank">
        <i class="fas fa-file-pdf"></i>
    </a>
@endif
```

**En el formulario de edición**: se muestra un enlace al PDF actual con opción de reemplazarlo.

**En la vista show**: botón para ver/descargar el PDF.

**Eliminación automática**: cuando se borra un producto, también se eliminan su imagen y su PDF del disco:

```php
public function destroy(Productos $producto)
{
    if ($producto->imagen) {
        Storage::disk('public')->delete($producto->imagen);
    }
    if ($producto->archivo_pdf) {
        Storage::disk('public')->delete($producto->archivo_pdf);
    }
    $producto->delete();
}
```

---

## 5. Creación y uso de Roles (Admin, Usuario)

### Tablas de base de datos

La migración `2026_02_16_000000_create_roles_and_permissions_table.php` crea 4 tablas:

```
roles              → id, name, description, timestamps
permissions        → id, name, description, timestamps
role_user          → id, user_id (FK), role_id (FK), timestamps
permission_role    → id, permission_id (FK), role_id (FK), timestamps
```

### Modelos

**`app/Models/Role.php`**:
```php
public function users()      → belongsToMany(User::class, 'role_user')
public function permissions() → belongsToMany(Permission::class, 'permission_role')
```

**`app/Models/Permission.php`**:
```php
public function roles() → belongsToMany(Role::class, 'permission_role')
```

**`app/Models/User.php`** – métodos añadidos:
```php
public function roles()          → belongsToMany(Role::class, 'role_user')
public function hasRole($role)   → comprueba si el usuario tiene un rol específico
public function isAdmin()        → comprueba si tiene el rol "Admin"
public function isUser()         → comprueba si tiene el rol "Usuario"
public function hasPermission()  → comprueba si tiene un permiso a través de sus roles
```

### Seeder de Roles y Permisos

El archivo `database/seeders/RolesAndPermissionsSeeder.php` crea:

**Roles**:
| Rol | Descripción |
|---|---|
| Admin | Administrador con acceso completo |
| Usuario | Usuario con acceso limitado (crear y editar) |

**Permisos**:
| Permiso | Admin | Usuario |
|---|---|---|
| crear | ✅ | ✅ |
| editar | ✅ | ✅ |
| ver | ✅ | ✅ |
| eliminar | ✅ | ❌ |

El seeder también crea dos usuarios de prueba y les asigna sus roles.

---

## 6. Control de permisos en vistas

### Botón Eliminar – Solo Admin

En las 5 vistas `index.blade.php`, el botón de eliminar está dentro de un `@if`:

```blade
@if(auth()->user()->isAdmin())
<form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger"
            onclick="return confirm('¿Está seguro de eliminar este cliente?')">
        <i class="fas fa-trash"></i>
    </button>
</form>
@endif
```

Si el usuario tiene rol **Usuario**, el botón no aparece en el HTML.

### Protección en los Controllers

Aunque el botón no se muestre, alguien podría enviar la petición DELETE directamente. Por eso, cada método `destroy()` de los 5 controllers verifica el rol:

```php
public function destroy(Clientes $cliente)
{
    if (!auth()->user()->isAdmin()) {
        return redirect()->route('clientes.index')
            ->with('error', 'No tiene permisos para eliminar clientes.');
    }
    // ... proceder con la eliminación
}
```

### Mensajes de error

Si un usuario sin permisos intenta eliminar, se muestra un alert rojo:

```blade
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <strong>¡Error!</strong> {{ $message }}
    </div>
@endif
```

### Resumen de acciones por rol

| Acción | Admin | Usuario |
|---|---|---|
| Ver listados (index) | ✅ | ✅ |
| Ver detalle (show) | ✅ | ✅ |
| Crear registros (create/store) | ✅ | ✅ |
| Editar registros (edit/update) | ✅ | ✅ |
| Eliminar registros (destroy) | ✅ | ❌ |

### Rol del usuario en el Dashboard

En la vista `home.blade.php` se muestra el rol del usuario actual:

```blade
<p>
    <i class="fas fa-user-shield"></i> Rol:
    @foreach(Auth::user()->roles as $role)
        <span class="badge badge-{{ $role->name == 'Admin' ? 'danger' : 'info' }}">
            {{ $role->name }}
        </span>
    @endforeach
</p>
```

---

## Base de datos – Migraciones añadidas

| Migración | Descripción |
|---|---|
| `2026_02_16_000000_create_roles_and_permissions_table` | Crea tablas: `roles`, `permissions`, `role_user`, `permission_role` |
| `2026_02_16_000001_add_images_and_files_to_tables` | Añade `foto` a clientes, `imagen` y `archivo_pdf` a productos |
| `2026_02_18_000000_add_apellido_to_clientes_and_empleados` | Añade columna `apellido` a clientes y empleados |

---

## Archivos modificados y creados

### Modelos modificados
- `app/Models/User.php` – añadidos métodos de roles y permisos
- `app/Models/Clientes.php` – añadidos `apellido` y `foto` a `$fillable`
- `app/Models/Productos.php` – añadidos `imagen` y `archivo_pdf` a `$fillable`
- `app/Models/Empleado.php` – añadido `apellido` a `$fillable` + accessor `fecha_inicio`

### Modelos creados
- `app/Models/Role.php` – modelo con relaciones users y permissions
- `app/Models/Permission.php` – modelo con relación roles

### Controllers modificados
- `app/Http/Controllers/ClientesController.php` – paginate, foto upload
- `app/Http/Controllers/ProductoController.php` – paginate, imagen + PDF upload, show method
- `app/Http/Controllers/EmpleadoController.php` – paginate, mapping fecha_inicio → fecha_contratacion
- `app/Http/Controllers/CategoriaController.php` – paginate
- `app/Http/Controllers/PedidoController.php` – paginate

### Vistas modificadas
- `resources/views/home.blade.php` – muestra rol del usuario
- `resources/views/clientes/index.blade.php` – DataTables, paginación, columna foto, permisos
- `resources/views/clientes/show.blade.php` – muestra foto del cliente
- `resources/views/productos/index.blade.php` – DataTables, paginación, columnas imagen y PDF, permisos
- `resources/views/productos/show.blade.php` – muestra imagen y enlace PDF
- `resources/views/empleados/index.blade.php` – DataTables, paginación, permisos
- `resources/views/categorias/index.blade.php` – DataTables, paginación, permisos
- `resources/views/pedidos/index.blade.php` – DataTables, paginación, permisos

### Seeders creados
- `database/seeders/RolesAndPermissionsSeeder.php` – crea roles, permisos y usuarios

### Configuración modificada
- `app/Providers/AppServiceProvider.php` – `Paginator::useBootstrapFive()`
- `config/adminlte.php` – DataTables plugin activo

---

## Cómo instalar y probar

### 1. Instalar dependencias

```bash
cd C:\xampp\htdocs\test\nombre_proyecto
composer install
```

### 2. Configurar .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=nombre_proyecto
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

Esto creará todas las tablas, los datos de prueba, los roles, permisos y los dos usuarios.

### 4. Crear symlink de storage

```bash
php artisan storage:link
```

Necesario para que las imágenes y PDFs subidos sean accesibles desde el navegador.

### 5. Iniciar el servidor

```bash
php artisan serve
```

Abrir: http://localhost:8000

---

## Usuarios de prueba

| Usuario | Email | Contraseña | Rol | Puede eliminar |
|---|---|---|---|---|
| Admin | admin@example.com | password | Admin | ✅ Sí |
| Usuario | usuario@example.com | password | Usuario | ❌ No |

### Cómo probar los permisos

1. Inicia sesión con `admin@example.com` → verás los botones de eliminar (🗑️) en todas las tablas
2. Cierra sesión y entra con `usuario@example.com` → los botones de eliminar desaparecen
3. Intenta acceder a una URL de eliminación directamente → recibirás mensaje de error

### Cómo probar la subida de archivos

1. Ve a **Clientes → Nuevo Cliente** → rellena el formulario y sube una foto
2. Ve a **Productos → Nuevo Producto** → sube una imagen y un PDF
3. Comprueba que aparecen en la tabla del listado y en la vista de detalle

---

## Tecnologías utilizadas

| Tecnología | Versión | Uso |
|---|---|---|
| Laravel | 12 | Framework PHP |
| PHP | 8.2+ | Lenguaje backend |
| MySQL | 8.x | Base de datos |
| AdminLTE | 3.15 | Plantilla de administración |
| Bootstrap | 4 | Framework CSS (vía AdminLTE) |
| jQuery DataTables | 1.10.19 | Plugin de tablas interactivas |
| jQuery | 3.x | Librería JS (vía AdminLTE) |
| Font Awesome | 5.x | Iconos (vía AdminLTE) |
