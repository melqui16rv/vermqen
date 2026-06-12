# VERMQEN Wiki

Wiki modular para documentar el proyecto VERMQEN. Cada módulo del sistema tiene su propia tarjeta y manual organizado por categorías.

## Stack

| Capa | Tecnología |
|---|---|
| Lenguaje | PHP 8.2+ |
| Framework HTTP | Slim 4 |
| Templates | Twig 3 |
| CSS | Bootstrap 5.3 + Bootstrap Icons |
| JS reactivo | Alpine.js 3 |
| Animaciones | AOS |

---

## Estructura del proyecto

```
vermqen/
│
├── index.php                        ← Punto de entrada (bootstrap de Slim + Twig)
├── composer.json                    ← Dependencias (vendor-dir: assets/vendor)
├── .htaccess                        ← URL rewrite para Apache
│
├── app/                             ← Lógica PHP (PSR-4: App\)
│   ├── Content/
│   │   └── ContentRepository.php   ← Carga y expone los módulos
│   ├── Controllers/
│   │   └── PageController.php      ← Maneja las rutas home y módulo
│   └── Routes/
│       └── web.php                  ← Registro de rutas en Slim
│
├── content/                         ← DATOS de los módulos (PHP arrays)
│   ├── wiki-modules.php             ← Cargador automático (glob)
│   └── modules/
│       ├── devops/                  ← Categoría: DevOps & Entorno
│       │   ├── manejo-git.php
│       │   ├── ejecucion-servidor.php
│       │   └── ejecucion-migraciones.php
│       ├── sistema/                 ← Categoría: Módulos del Sistema
│       │   ├── ciudad-verde.php
│       │   ├── gestor-curricular.php
│       │   ├── ingreso-salida.php
│       │   ├── presupuesto.php
│       │   └── control-portatiles.php
│       └── microservicios/          ← Categoría: Microservicios
│           └── almacen.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── base.twig            ← Layout base (header, nav dropdowns, footer)
│       ├── pages/
│       │   ├── home.twig            ← Página principal con tarjetas por categoría
│       │   ├── module.twig          ← Fallback (compatibilidad)
│       │   └── not-found.twig       ← Página 404
│       └── modules/                 ← Templates por tipo de módulo
│           ├── manual.twig          ← Módulos tipo paso a paso (DevOps)
│           └── reference.twig       ← Módulos tipo referencia (Sistema)
│
└── assets/
    ├── css/
    │   └── app.css                  ← Estilos personalizados
    ├── js/
    │   └── app.js                   ← Filtro de búsqueda + AOS + tilt
    └── vendor/                      ← Dependencias Composer
```

---

## Flujo de una tarjeta (de dato a HTML)

```
content/modules/{categoria}/modulo.php   ← PHP array con título, resumen, features...
        │  (glob automático)
        ▼
content/wiki-modules.php                 ← Cargador: une todos los módulos en un array
        │  (ContentRepository::allModules)
        ▼
app/Content/ContentRepository.php        ← Lee el array y lo expone
        │  (PageController::home)
        ▼
app/Controllers/PageController.php       ← Agrupa por categoría, construye rutas
        │  (Twig::render 'pages/home.twig')
        ▼
resources/views/pages/home.twig          ← Loop: genera <article class="module-card">
        │  (extends layouts/base.twig)
        ▼
resources/views/layouts/base.twig        ← Nav con dropdowns + Bootstrap + app.css
        │
        ▼
🌐 Navegador recibe el HTML final
```

---

## Cómo agregar un módulo nuevo

1. Crea un archivo PHP en `content/modules/{categoria}/mi-modulo.php`
2. Retorna un array con los campos del módulo:

```php
<?php
return [
    'category' => 'sistema',             // devops | sistema | microservicios
    'template' => 'modules/manual.twig', // manual.twig | reference.twig
    'nav'      => 'Mi Módulo',           // Texto en el navbar
    'title'    => 'Nombre completo',
    'tag'      => 'Sistema',
    'summary'  => 'Descripción breve para la tarjeta del home.',
    'intro'    => 'Descripción larga para el hero de la página del módulo.',
    // Campos adicionales según el template elegido...
];
```

3. ✅ Listo — aparece automáticamente en el home, en el navbar y tiene su URL `/{slug}`.

### Campos para `manual.twig` (DevOps, paso a paso)

```php
'pillars'  => [['icon' => 'bi-gear', 'title' => '...', 'text' => '...']],
'workflow' => [['step' => '1. ...', 'detail' => '...', 'command' => '...']],
'checklist'=> ['Ítem 1', 'Ítem 2'],
'resources'=> [['label' => '...', 'url' => 'https://...']],
```

### Campos para `reference.twig` (Módulos del sistema)

```php
'features'        => [['icon' => 'bi-box', 'title' => '...', 'text' => '...']],
'related_modules' => [['label' => '...', 'slug' => '...', 'description' => '...']],
'resources'       => [['label' => '...', 'url' => 'https://...']],
```

---

## Levantar en local

```bash
# El vendor ya está en assets/vendor/ — no hace falta composer install
php -S localhost:8080 index.php
```

Abrir: `http://localhost:8080/`

Fallback sin rewrite (hosting compartido):
```
http://localhost:8080/index.php?route=manejo-git
```

---

## Desplegar en hosting compartido (Apache)

1. Subir el repositorio completo.
2. Asegurar que Apache tiene `mod_rewrite` activo (se usa `.htaccess`).
3. Abrir el sitio — el `vendor/` ya está incluido en `assets/vendor/`.

---

## Nota de seguridad operativa

Este repositorio **solo** documenta el proyecto.  
No ejecutar comandos sobre el sistema principal en producción:

```
vermqen-laravel/
```
