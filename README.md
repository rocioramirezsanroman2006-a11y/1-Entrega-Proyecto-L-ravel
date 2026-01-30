# TechPink Hub - CRM Empresarial 💎

Aplicación web profesional de gestión empresarial desarrollada con **Laravel 12** e interfaz **AdminLTE 3** con tema rosa pastel personalizado. Proporciona un panel de control completo para administrar 5 módulos CRUD.

---

## 📋 Descripción del Proyecto

**TechPink Hub** es un CRM (Customer Relationship Management) moderno para gestionar información empresarial completa. Incluye gestión de clientes, productos, empleados, categorías y pedidos.

### Módulos Incluidos

- **👥 Clientes** - Gestión completa de clientes con contacto
- **👔 Empleados** - Control de empleados y salarios en €
- **📦 Productos** - Catálogo con precios y stock
- **🏷️ Categorías** - Clasificación de productos
- **🛒 Pedidos** - Gestión de pedidos con seguimiento

### ✨ Características

✅ **5 Módulos CRUD** completos y funcionales  
✅ **Autenticación Segura** - Sistema de login con Laravel Auth  
✅ **Base de Datos Relacional** - MySQL con migraciones  
✅ **Interfaz Profesional** - AdminLTE 3 + Bootstrap 5  
✅ **Tema Personalizado** - Rosa pastel moderno (#FFB6D9)  
✅ **Datos de Prueba** - Seeders precargados  
✅ **Responsive Design** - Funciona en móvil y escritorio  

---

## 🛠️ Requisitos Técnicos

| Software | Versión | Cómo instalar |
|----------|---------|---------------|
| **PHP** | 8.1+ | Incluido en XAMPP |
| **MySQL** | 5.7+ | Incluido en XAMPP |
| **Composer** | Latest | https://getcomposer.org/ |
| **Node.js** | 18+ | Opcional |

**Forma más fácil:** Descargar XAMPP → https://www.apachefriends.org/

---

## 📦 Pasos de Instalación

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

## 📊 Datos Precargados

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
