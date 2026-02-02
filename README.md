# TechPink Hub - CRM Empresarial

## ¿Qué es esto?

Es una aplicación web para gestionar cosas de una empresa. Básicamente puedes hacer CRUD de 5 cosas: clientes, productos, empleados, categorías y pedidos.

Lo hice con Laravel porque es el framework que tocaba en clase. La interfaz es con AdminLTE que viene con unos estilos ya listos, y le cambié los colores a rosa pastel porque quedaba bien.

Tiene login, así que tienes que identificarte para entrar. Después de eso ves un dashboard que te muestra cuántos clientes, productos, empleados y pedidos tienes. Desde ahí puedes ir a cada módulo.

Cada módulo es igual: una tabla que te muestra todos los registros, y botones para crear, editar o eliminar. Nada complicado.

La base de datos tiene 5 tablas principales (clientes, productos, empleados, categorías, pedidos) y otras que Laravel crea por defecto. Los productos están relacionados con categorías, y los pedidos con clientes.

Viene con datos de prueba ya metidos, así que cuando abras la app ya ves 5 clientes, 8 productos, 5 empleados, etc. No tienes que crear nada si no quieres, simplemente puedes probar todo que ya funciona.

---

## ¿Qué necesito?

### 1️⃣ Clonar o Descargar Proyecto

```bash
# Opción A: Clonar desde GitHub
git clone https://github.com/tu-usuario/nombre_proyecto.git
cd nombre_proyecto

# Opción B: Si lo tienes descargado
cd C:\xampp\htdocs\test\nombre_proyecto

# Copiar proyecto en esta carpeta
# La carpeta debe llamarse: nombre_proyecto
```

### 2️⃣ Instalar Dependencias

```bash
cd nombre_proyecto
composer install
```

### 3️⃣ Configurar .env

```bash
copy .env.example .env
```

**Editar `.env`:**
```env
APP_NAME="Gestión Empresarial"
APP_URL=http://localhost/test/nombre_proyecto/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=nombre_proyecto
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
```

### 4️⃣ Generar Clave

```bash
php artisan key:generate
```

### 5️⃣ Crear BD

```bash
mysql -u root -e "CREATE DATABASE nombre_proyecto;"
```

### 6️⃣ Migraciones y Datos

```bash
php artisan migrate:fresh --seed
```

### 7️⃣ Iniciar Aplicación

```bash
# Opción A - Laravel Server
php artisan serve
# Acceder a: http://localhost:8000

# Opción B - A través de XAMPP
# Acceder a: http://localhost/test/nombre_proyecto/public/
```

---

## 👤 Usuario y Contraseña de Prueba

```
📧 Email:     admin@example.com
🔑 Contraseña: password
```

**Inicia sesión y accede al dashboard!**

---

## � Pantallas y Navegación

### 1️⃣ Pantalla de Login
**URL:** `http://localhost:8000/login`

- Interfaz moderna con tema rosa pastel
- Campos: Email y Contraseña
- Botón "Iniciar Sesión"
- Enlace para recuperar contraseña

**Credenciales:**
```
Email: admin@example.com
Contraseña: password
```

---

### 2️⃣ Dashboard Principal (Home)
**URL:** `http://localhost:8000/home`

Pantalla inicial después de login con:

- **Encabezado:** "¡Bienvenido, Admin!" con tema gradiente rosa
- **4 Tarjetas de Estadísticas:**
  - 👥 **Total Clientes:** 5 (Azul Pastel)
  - 👔 **Total Empleados:** 5 (Púrpura Pastel)
  - 📦 **Total Productos:** 8 (Verde Pastel)
  - 🛒 **Total Pedidos:** 5 (Rosa Pastel)

Cada tarjeta tiene:
- Icono descriptivo
- Número de registros
- Botón "Ver todos" para ir al módulo correspondiente

---

### 3️⃣ Menú Lateral (Sidebar)

**Color:** Rosa pastel (#F5B3D4)

**Opciones del menú:**
```
HOME              🏠 Dashboard
CATEGORÍAS        🏷️ Listar/Crear categorías
CLIENTES          👥 Listar/Crear clientes
EMPLEADOS         👔 Listar/Crear empleados
PRODUCTOS         📦 Listar/Crear productos
PEDIDOS           🛒 Listar/Crear pedidos
CERRAR SESIÓN     🚪 Logout
```

Cada módulo tiene acceso rápido a:
- Listar todos los registros
- Crear nuevo registro

---

### 4️⃣ Módulo Clientes
**URL:** `http://localhost:8000/clientes`

#### Lista de Clientes
- **Encabezado:** Rosa con ícono 👥
- **Tabla con columnas:**
  - ID (Badge Azul Pastel)
  - Nombre (Negrita)
  - Email (Enlace)
  - Teléfono
  - Empresa
  - Acciones (Ver, Editar, Eliminar)

- **Botón Crear:** "Nuevo Cliente" (Azul Pastel)

#### Crear/Editar Cliente
Formulario con campos:
- Nombre* (requerido)
- Email* (requerido, único)
- Teléfono
- Dirección
- Ciudad
- Código Postal
- Empresa

---

### 5️⃣ Módulo Productos
**URL:** `http://localhost:8000/productos`

#### Lista de Productos
- **Encabezado:** Verde pastel con ícono 📦
- **Tabla con columnas:**
  - ID (Badge Verde)
  - Nombre
  - Descripción (Truncada)
  - Precio: €XX.XX (Verde)
  - Stock
  - Categoría
  - Acciones

- **Botón Crear:** "Nuevo Producto" (Verde Pastel)

#### Crear/Editar Producto
Formulario con campos:
- Nombre* (requerido)
- Descripción
- Precio*€ (requerido)
- Stock* (requerido)
- Categoría* (Dropdown)

---

### 6️⃣ Módulo Empleados
**URL:** `http://localhost:8000/empleados`

#### Lista de Empleados
- **Encabezado:** Púrpura pastel con ícono 👔
- **Tabla con columnas:**
  - ID (Badge Púrpura)
  - Nombre
  - Email (Enlace)
  - Teléfono
  - Puesto
  - Departamento
  - Salario: €XXXX.XX (Púrpura)
  - Acciones

- **Botón Crear:** "Nuevo Empleado" (Púrpura Pastel)

#### Crear/Editar Empleado
Formulario con campos:
- Nombre* (requerido)
- Email* (requerido, único)
- Teléfono
- Puesto* (requerido)
- Departamento
- Fecha Contratación
- Salario* (requerido)

---

### 7️⃣ Módulo Categorías
**URL:** `http://localhost:8000/categorias`

#### Lista de Categorías
- **Encabezado:** Amarillo pastel con ícono 🏷️
- **Tabla con columnas:**
  - ID (Badge Amarillo)
  - Nombre
  - Descripción (Truncada)
  - Acciones

- **Botón Crear:** "Nueva Categoría" (Amarillo Pastel)

#### Crear/Editar Categoría
Formulario simple:
- Nombre* (requerido, único)
- Descripción

---

### 8️⃣ Módulo Pedidos
**URL:** `http://localhost:8000/pedidos`

#### Lista de Pedidos
- **Encabezado:** Rosa pastel con ícono 🛒
- **Tabla con columnas:**
  - ID (Badge Rosa)
  - Número Pedido
  - Cliente
  - Fecha Pedido
  - Fecha Entrega
  - Total: €XXXX.XX (Rosa)
  - Estado (Badges de colores)
  - Acciones

**Estados y Colores:**
- 🔴 Pendiente (Rojo)
- 🟡 En Proceso (Amarillo)
- 🟢 Completado (Verde)
- Cancelado (Gris)

- **Botón Crear:** "Nuevo Pedido" (Rosa Pastel)

#### Crear/Editar Pedido
Formulario con campos:
- Número Pedido* (requerido, único)
- Cliente* (Dropdown)
- Fecha Pedido* (requerido)
- Fecha Entrega
- Total*€ (requerido)
- Estado* (Dropdown: Pendiente, En Proceso, Completado, Cancelado)
- Descripción

---

## 🎨 Esquema de Colores

| Módulo | Color Pastel | Código | Usar Para |
|--------|-------------|--------|-----------|
| Principal | Rosa Claro | #FFD6E8 | Navbar, Headers |
| Clientes | Azul Pastel | #D6E8F5 | Headers, Badges |
| Productos | Verde Pastel | #D6F5E8 | Headers, Badges |
| Empleados | Púrpura Pastel | #E8D6F5 | Headers, Badges |
| Categorías | Amarillo Pastel | #F5F0D6 | Headers, Badges |
| Pedidos | Rosa Pastel | #FFD6E8 | Headers, Badges |

---

## ⚡ Funcionalidades en Cada Pantalla

### Listar (Index)
- ✅ Tabla con todos los registros
- ✅ Paginación si hay muchos registros
- ✅ Botón "Nuevo" para crear
- ✅ Botones de acciones: Ver, Editar, Eliminar
- ✅ Mensajes de éxito/error
- ✅ Campo de búsqueda (opcional)

### Crear (Create)
- ✅ Formulario vacío
- ✅ Validación de campos requeridos
- ✅ Validación de emails únicos
- ✅ Guardado en BD
- ✅ Redirección a lista con mensaje de éxito

### Editar (Edit)
- ✅ Formulario pre-rellenado con datos
- ✅ Mismas validaciones que crear
- ✅ Actualización en BD
- ✅ Redirección a lista con mensaje

### Eliminar (Delete)
- ✅ Confirmación antes de eliminar
- ✅ Eliminación en cascada (relaciones)
- ✅ Mensaje de éxito
- ✅ Redirección a lista

---

## 📊 Datos de Prueba (25+ registros)

| Tabla | Cantidad | Descripción |
|-------|----------|-------------|
| **users** | 1 | Usuario admin |
| **clientes** | 5 | Clientes con contacto |
| **empleados** | 5 | Empleados con salarios |
| **categorias** | 4 | Categorías de productos |
| **productos** | 8 | Productos con precio/stock |
| **pedidos** | 5 | Pedidos con estados |

**Total:** 25+ registros de datos reales listos para usar

---

## 🗄️ Base de Datos - SQL

### Tablas Creadas

```sql
-- Usuario
CREATE TABLE users (
  id INTEGER PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255)
);

-- Clientes
CREATE TABLE clientes (
  id INTEGER PRIMARY KEY,
  nombre VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  telefono VARCHAR(20),
  direccion TEXT,
  ciudad VARCHAR(100),
  codigo_postal VARCHAR(10),
  empresa VARCHAR(100),
  timestamps
);

-- Empleados
CREATE TABLE empleados (
  id INTEGER PRIMARY KEY,
  nombre VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  telefono VARCHAR(20),
  puesto VARCHAR(100),
  departamento VARCHAR(100),
  fecha_contratacion DATE,
  salario DECIMAL(8,2),
  timestamps
);

-- Categorías
CREATE TABLE categorias (
  id INTEGER PRIMARY KEY,
  nombre VARCHAR(255) UNIQUE,
  descripcion TEXT,
  timestamps
);

-- Productos
CREATE TABLE productos (
  id INTEGER PRIMARY KEY,
  nombre VARCHAR(255),
  descripcion TEXT,
  precio DECIMAL(8,2),
  stock INTEGER,
  categoria_id INTEGER (Foreign Key),
  timestamps
);

-- Pedidos
CREATE TABLE pedidos (
  id INTEGER PRIMARY KEY,
  numero_pedido VARCHAR(255) UNIQUE,
  cliente_id INTEGER (Foreign Key),
  fecha_pedido DATE,
  fecha_entrega DATE,
  total DECIMAL(10,2),
  estado VARCHAR(50),
  descripcion TEXT,
  timestamps
);
```

### Relaciones

- **Clientes ↔ Pedidos** (1 a N)
- **Categorías ↔ Productos** (1 a N)

### Backup Completo

**Archivo:** `database_backup.sql`

Contiene:
✅ Estructura de todas las tablas  
✅ 25+ registros de datos  
✅ Usuario administrador  
✅ Relaciones y llaves foráneas  

**Restaurar:**
```bash
mysql -u root nombre_proyecto < database_backup.sql
```

---

## 📁 Estructura del Proyecto

```
nombre_proyecto/
├── app/
│   ├── Http/Controllers/
│   │   ├── ClientesController.php
│   │   ├── EmpleadoController.php
│   │   ├── ProductosController.php
│   │   ├── CategoriaController.php
│   │   └── PedidoController.php
│   └── Models/
│       ├── Clientes.php
│       ├── Empleado.php
│       ├── Productos.php
│       ├── Categoria.php
│       └── Pedido.php
│
├── database/
│   ├── migrations/        # Scripts de BD
│   └── seeders/           # Datos de prueba
│
├── resources/views/
│   ├── home.blade.php     # Dashboard
│   ├── clientes/
│   ├── empleados/
│   ├── productos/
│   ├── categorias/
│   └── pedidos/
│
├── routes/
│   └── web.php            # Rutas
│
├── .env                   # Variables de entorno
├── .env.example           # Ejemplo
├── database_backup.sql    # 📊 BACKUP COMPLETO
└── README.md              # Este archivo
```

---

## 🎯 Funcionalidades

### Dashboard
- Estadísticas en tiempo real
- Resumen de últimos pedidos
- Accesos rápidos a crear registros

### Clientes
- Crear/Editar/Eliminar clientes
- Información de contacto completa
- Vista detallada por cliente

### Empleados  
- Registro de empleados
- Gestión de departamentos y salarios
- Fechas de contratación

### Productos
- Catálogo de productos
- Asignación a categorías
- Control de inventario

### Categorías
- Crear/Editar/Eliminar categorías
- Descripción de categorías
- Asignación a productos

### Pedidos
- Crear pedidos de clientes
- Estados: Pendiente, En Proceso, Completado, Cancelado
- Seguimiento completo

---

## 🔐 Seguridad

✅ Autenticación Laravel integrada  
✅ CSRF Protection en formularios  
✅ Hash bcrypt en contraseñas  
✅ Validación de entrada  
✅ Eloquent ORM contra SQL Injection  

---

## 🛠️ Comandos Útiles

```bash
# Migraciones
php artisan migrate:fresh --seed    # Reset + datos
php artisan migrate:rollback        # Revertir

# Seeders
php artisan db:seed                 # Cargar datos

# Caché
php artisan cache:clear             # Limpiar caché
php artisan config:cache            # Cachear config

# Servidor
php artisan serve                   # Iniciar servidor
php artisan serve --port=8080       # Otro puerto
```

---

## 📚 Tecnologías

- **Laravel** 11.0
- **PHP** 8.2+
- **MySQL** 8.0+
- **Bootstrap** 5.0
- **AdminLTE** 3.0
- **Eloquent ORM**

---

## 📝 Rutas Principales

```
GET    /login              # Login
POST   /login              # Procesar login
POST   /logout             # Cerrar sesión

GET    /home               # Dashboard

GET    /clientes           # Listar
POST   /clientes           # Crear
GET    /clientes/{id}      # Ver
PUT    /clientes/{id}      # Actualizar
DELETE /clientes/{id}      # Eliminar

GET    /empleados          # Listar
POST   /empleados          # Crear
... (igual para empleados)

GET    /productos          # Listar
... (igual para productos)

GET    /categorias         # Listar
... (igual para categorías)

GET    /pedidos            # Listar
... (igual para pedidos)
```

---

## 🐛 Problemas Comunes

**BD no existe:**
```bash
mysql -u root -e "CREATE DATABASE nombre_proyecto;"
php artisan migrate:fresh --seed
```

**Port 8000 en uso:**
```bash
php artisan serve --port=8080
```

**Error de permisos (Linux):**
```bash
chmod -R 755 storage/ bootstrap/cache/
```

---

## ✅ Checklist

- [ ] PHP 8.2+ instalado
- [ ] MySQL ejecutándose
- [ ] Composer instalado
- [ ] `composer install` ✓
- [ ] `.env` configurado ✓
- [ ] `php artisan key:generate` ✓
- [ ] BD creada ✓
- [ ] `php artisan migrate:fresh --seed` ✓
- [ ] Servidor iniciado ✓
- [ ] Login exitoso ✓
- [ ] Todos los módulos funcionan ✓

---

## 📞 Documentación

- Laravel: https://laravel.com/docs
- AdminLTE: https://adminlte.io/
- MySQL: https://dev.mysql.com/doc/

---

## 📄 Licencia

MIT License - Código abierto y libre

---

**¡Disfruta tu aplicación! 🚀**

Desarrollado con ❤️ usando Laravel 11 + AdminLTE 3
