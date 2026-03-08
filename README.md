```markdown
# Sistema de Gestión de Clientes y Pedidos

Aplicación web desarrollada con Laravel y Livewire para la gestión de clientes y pedidos. Permite administrar información de clientes, registrar pedidos y visualizar datos de forma dinámica sin recargar la página.

## Tecnologías utilizadas

- Laravel  
- Livewire  
- Blade  
- MySQL  
- PHP 8+

## Funcionalidades

- Gestión de clientes
  - Crear clientes
  - Editar clientes
  - Eliminar clientes
  - Listar clientes

- Gestión de pedidos
  - Crear pedidos
  - Asociar pedidos a clientes
  - Editar pedidos
  - Eliminar pedidos
  - Listar pedidos

- Búsqueda y filtrado dinámico con Livewire  
- Actualización de datos sin recargar la página  
- Relación Cliente → Pedidos

## Estructura del proyecto

```

app/
├── Http/
│   └── Livewire/
│       ├── Clientes/
│       └── Pedidos/
database/
├── migrations/
resources/
├── views/
│   ├── clientes/
│   └── pedidos/
routes/
└── web.php

````

## Instalación

### Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
````

### Instalar dependencias

```bash
composer install
npm install
```

### Configurar variables de entorno

```bash
cp .env.example .env
```

Configurar la conexión a la base de datos en el archivo `.env`.

### Generar clave de aplicación

```bash
php artisan key:generate
```

### Ejecutar migraciones

```bash
php artisan migrate
```

### Iniciar servidor

```bash
php artisan serve
```

La aplicación estará disponible en:

```
http://localhost:8000
```

## Modelo de datos

Clientes

* id
* nombre
* email
* teléfono
* dirección

Pedidos

* id
* cliente_id
* fecha
* estado
* total

Relación

```
Cliente (1) ---- (N) Pedidos
```

## Autor



```
![Logo](GestionPedido/public/Logo.png)
```

