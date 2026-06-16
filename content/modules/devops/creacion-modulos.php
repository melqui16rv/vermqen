<?php

declare(strict_types=1);

return [
    'category'       => 'devops',
    'category_label' => 'DevOps & Entorno',
    'template'       => 'modules/manual.twig',
    'nav'            => 'Creación Módulos',
    'title'          => 'Creación de Módulos',
    'tag'            => 'Desarrollo',
    'summary'        => 'Guía estructurada para crear nuevos módulos en el proyecto.',
    'intro'          => 'Este manual detalla los pasos y comandos necesarios para generar e integrar nuevos módulos en la arquitectura del proyecto.',
    'module_guide'   => [
        'title'       => 'Estructura para agregar un módulo nuevo al proyecto',
        'description' => 'Al crear un nuevo módulo en vermqen-laravel se debe seguir la estructura estándar del proyecto. Cada módulo se encapsula en su propia carpeta, documentado con su nombre en controladores, modelos, vistas y rutas.',
        'steps'       => [
            [
                'icon'        => 'bi-folder-plus',
                'label'       => '1. Controlador del módulo',
                'path'        => 'app/Http/Controllers/NombreModulo/',
                'description' => 'Crear la carpeta con el nombre del módulo y dentro el controlador principal. Usar PascalCase para el namespace y el nombre de clase.',
                'example'     => "namespace App\\Http\\Controllers\\NombreModulo;\n\nuse App\\Http\\Controllers\\Controller;\n\n// ── NombreModulo ──────────────────────────────────\nclass NombreModuloController extends Controller\n{\n    public function index() { }\n    public function create() { }\n    public function store() { }\n    public function edit() { }\n    public function update() { }\n    public function destroy() { }\n}",
            ],
            [
                'icon'        => 'bi-database',
                'label'       => '2. Modelo Eloquent',
                'path'        => 'app/Models/NombreModulo.php',
                'description' => 'Crear el modelo que representa la entidad en base de datos. Definir la tabla, los campos fillable y las relaciones necesarias.',
                'example'     => "namespace App\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\n// ── NombreModulo ──────────────────────────────────\nclass NombreModulo extends Model\n{\n    protected \$table    = 'nombre_modulo';\n    protected \$fillable = ['campo_1', 'campo_2'];\n}",
            ],
            [
                'icon'        => 'bi-layout-text-window',
                'label'       => '3. Vistas del módulo',
                'path'        => 'resources/views/nombre-modulo/',
                'description' => 'Crear la carpeta con el slug del módulo (kebab-case) y las vistas Blade que necesite: index, create, edit y show.',
                'example'     => "resources/views/nombre-modulo/\n├── index.blade.php     ← listado\n├── create.blade.php    ← formulario de creación\n├── edit.blade.php      ← formulario de edición\n└── show.blade.php      ← detalle de un registro",
            ],
            [
                'icon'        => 'bi-diagram-3',
                'label'       => '4. Módulos con múltiples secciones',
                'path'        => 'resources/views/nombre-modulo/seccion/',
                'description' => 'Si el módulo es complejo y contiene varias entidades o submódulos, organízalas en carpetas separadas dentro del módulo. Cada carpeta debe contener sus respectivas acciones CRUD.',
                'example'     => "resources/views/sistema_control_portatiles/\n├── asignaciones/\n│   ├── index.blade.php\n│   ├── create.blade.php\n│   └── edit.blade.php\n├── devoluciones/\n│   ├── index.blade.php\n│   └── create.blade.php\n└── portatiles/\n    ├── index.blade.php\n    └── show.blade.php",
            ],
            [
                'icon'        => 'bi-signpost-2',
                'label'       => '5. Rutas en web.php',
                'path'        => 'routes/web.php',
                'description' => 'Registrar las rutas del módulo agrupadas bajo su prefijo y name, documentadas con un comentario separador que lleva el nombre del módulo.',
                'example'     => "// ── NombreModulo ──────────────────────────────────\nuse App\\Http\\Controllers\\NombreModulo\\NombreModuloController;\n\nRoute::prefix('nombre-modulo')\n     ->name('nombre-modulo.')\n     ->middleware(['auth'])\n     ->group(function () {\n         Route::get('/',        [NombreModuloController::class, 'index' ])->name('index');\n         Route::get('/crear',   [NombreModuloController::class, 'create'])->name('create');\n         Route::post('/',       [NombreModuloController::class, 'store' ])->name('store');\n         Route::get('/{id}',    [NombreModuloController::class, 'show'  ])->name('show');\n         Route::put('/{id}',    [NombreModuloController::class, 'update'])->name('update');\n         Route::delete('/{id}', [NombreModuloController::class, 'destroy'])->name('destroy');\n     });",
            ],
            [
                'icon'        => 'bi-shield-lock',
                'label'       => '6. Permisos y Accesos (Visualización local)',
                'path'        => 'Base de datos (user_app_access)',
                'description' => 'Para poder visualizar y testear el nuevo módulo en tu entorno local, asegúrate de que tu usuario tenga rol de Administrador. Si el sistema restringe vistas por módulo y no logras verlo, debes otorgarte permisos insertando el registro correspondiente que vincule tu usuario al módulo en la tabla `user_app_access`.',
                'is_alert'    => true,
            ],
        ],
    ],
    'module_creation' => [
        'title'       => 'Creación de Módulos desde Consola',
        'description' => 'Pasos rápidos para generar toda la estructura base de un nuevo módulo utilizando los comandos de Artisan, siguiendo el patrón Modelo-Vista-Controlador (MVC).',
        'steps'       => [
            [
                'icon'        => 'bi-database-add',
                'label'       => '1. Generar Modelo y Migración',
                'path'        => 'Terminal',
                'description' => 'El flag `-m` le dice a Artisan que además del Modelo Eloquent, genere instantáneamente su archivo de migración en la carpeta database/migrations.',
                'example'     => "php artisan make:model NombreModulo -m",
            ],
            [
                'icon'        => 'bi-braces',
                'label'       => '2. Generar Controlador con Recursos',
                'path'        => 'Terminal',
                'description' => 'El flag `-r` (resource) crea un controlador que ya incluye todos los métodos CRUD vacíos: index, create, store, show, edit, update, destroy.',
                'example'     => "php artisan make:controller NombreModulo/NombreModuloController -r",
            ],
            [
                'icon'        => 'bi-window-plus',
                'label'       => '3. Crear Vistas y Rutas (Manual)',
                'path'        => 'Editor',
                'description' => 'Artisan no genera vistas automáticamente. Crea tu carpeta en `resources/views/nombre-modulo/` con tus vistas Blade/Twig, y registra el controlador generado en `routes/web.php` usando `Route::resource()` o definiendo las rutas manualmente.',
                'example'     => "mkdir resources/views/nombre-modulo",
            ],
        ],
    ],
    'layout_navigation' => [
        'title'       => 'Layout Propio y Navegación del Módulo',
        'description' => 'Para garantizar una experiencia coherente y escalable, todo módulo nuevo debe manejar su propia navegación interna pero integrarse de forma segura al panel general del sistema.',
        'steps'       => [
            [
                'icon'        => 'bi-layout-sidebar',
                'label'       => '1. Extender el Navbar y Crear Layout del Módulo',
                'path'        => 'resources/views/layouts/modulo.blade.php',
                'description' => 'Se debe construir un layout propio exclusivo para el módulo que direccione a todas sus secciones internas. Para no perder el contexto general, este layout propio **debe extender del layout principal del sistema** (`app.blade.php`), manteniendo así visible el Navbar principal y el entorno de AppCide.',
            ],
            [
                'icon'        => 'bi-compass',
                'label'       => '2. Registro en navigation.blade.php',
                'path'        => 'resources/views/navigation.blade.php',
                'description' => 'El nuevo módulo debe ser registrado como un enlace válido en el menú global de aplicaciones. Es fundamental envolver este enlace en un condicional de Blade validando que el usuario en sesión tiene los permisos necesarios (`@if`).',
                'example'     => "@if(\$hasPrestamoPortatiles)\n    <a href=\"{{ route('sistema-control-portatiles.index') }}\" \n       class=\"flex items-center space-x-4 p-4 rounded-lg hover:bg-gray-50 transition-colors group\">\n        <div class=\"w-12 h-12 shrink-0 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center shadow-md\">\n            <!-- SVG ICON -->\n        </div>\n        <div class=\"flex-1\">\n            <h4 class=\"font-semibold text-gray-900 group-hover:text-cyan-600 transition-colors text-sm\">Préstamo de Portátiles</h4>\n            <p class=\"text-xs text-gray-600\">Registro de préstamos a instructores</p>\n        </div>\n    </a>\n@endif",
            ],
        ],
    ],
];