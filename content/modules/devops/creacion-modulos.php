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

    'module_creation' => [
        'title'       => 'Creación de Módulos desde Consola',
        'description' => 'Pasos rápidos para generar toda la estructura base mediante Artisan.',
        'steps'       => [
            [
                'icon'        => 'bi-database-add',
                'label'       => '1. Generar Modelo y Migración',
                'path'        => 'Terminal',
                'image'       => '/assets/img/Referencia_comandos/Comando_ejecutado.jpg', 
                'description' => 'El flag -m genera el modelo y la migración al mismo tiempo.',
                'example'     => "php artisan make:model NombreModulo -m",
            ],
            [
                'icon'        => 'bi-braces',
                'label'       => '2. Generar Controlador con Recursos',
                'path'        => 'Terminal',
                'image'       => '/assets/img/Referencia_comandos/Controlador_ejecutado.jpg',
                'description' => 'El flag -r crea un controlador con los métodos CRUD vacíos.',
                'example'     => "php artisan make:controller NombreModulo/NombreModuloController -r",
            ],
            [
                'icon'        => 'bi-window-plus',
                'label'       => '3. Crear Vistas y Rutas (Manual)',
                'path'        => 'Editor',
                'image'       => '/assets/img/Referencia_comandos/Modulo_ejecutado.jpg',
                'description' => 'Crea tu carpeta de vistas y registra el controlador en routes/web.php.',
                'example'     => "mkdir resources/views/nombre-modulo",
            ],
        ],
    ],

    'glossary' => [
        'title'    => 'Conceptos Clave',
        'terms'    => [
            ['term' => 'Comando', 'definition' => 'Instrucción dada a la terminal (Artisan) para automatizar la creación de archivos del framework.'],
            ['term' => 'Módulo', 'definition' => 'Conjunto encapsulado de funcionalidades (Controller, Model, Views) que resuelven una necesidad específica.'],
        ],
        'relation' => 'Un módulo se construye ejecutando comandos de Artisan que generan la estructura base, la cual luego configuramos para integrar la lógica de negocio y las vistas correspondientes.'
    ],

    'module_guide'   => [
        'title'       => 'Estructura para agregar un módulo nuevo al proyecto',
        'description' => 'Al crear un nuevo módulo en vermqen-laravel se debe seguir la estructura estándar del proyecto. Cada módulo se encapsula en su propia carpeta, documentado con su nombre en controladores, modelos, vistas y rutas.',
        'steps'       => [
            [
                'icon'        => 'bi-folder-plus',
                'label'       => '1. Controlador del módulo',
                'path'        => 'app/Http/Controllers/NombreModulo/',
                'image'       => '/assets/img/Ejemplo_controlador.jpg',
                'description' => 'Crear la carpeta con el nombre del módulo y dentro el controlador principal. Usar PascalCase para el namespace y el nombre de clase.',
                'example'     => "namespace App\\Http\\Controllers\\NombreModulo;\n\nuse App\\Http\\Controllers\\Controller;\n\nclass NombreModuloController extends Controller\n{\n    public function index() { }\n    public function create() { }\n    public function store() { }\n}",
            ],
            [
                'icon'        => 'bi-database',
                'label'       => '2. Modelo Eloquent',
                'path'        => 'app/Models/NombreModulo.php',
                'image'       => '/assets/img/Referencia_comandos/visual_comando.jpg',
                'description' => 'Crear el modelo que representa la entidad en base de datos. Definir la tabla, los campos fillable y las relaciones necesarias.',
                'example'     => "namespace App\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass NombreModulo extends Model\n{\n    protected \$table    = 'nombre_modulo';\n    protected \$fillable = ['campo_1', 'campo_2'];\n}",
            ],
            [
                'icon'        => 'bi-layout-text-window',
                'label'       => '3. Vistas del módulo',
                'path'        => 'resources/views/nombre-modulo/',
                'image'       => '/assets/img/Referencia_comandos/Modulo_ejecutado.jpg',
                'description' => 'Crear la carpeta con el slug del módulo (kebab-case) y las vistas Blade que necesite: index, create, edit y show.',
                'example'     => "resources/views/nombre-modulo/\n├── index.blade.php     ← listado\n├── create.blade.php    ← creación\n├── edit.blade.php      ← edición\n└── show.blade.php      ← detalle",
            ],
            [
                'icon'        => 'bi-diagram-3',
                'label'       => '4. Módulos con múltiples secciones',
                'path'        => 'resources/views/nombre-modulo/seccion/',
                'image'       => '/assets/img/Referencia_comandos/Modulo_ejecutado.jpg',
                'description' => 'Si el módulo es complejo y contiene varias entidades o submódulos, organízalas en carpetas separadas dentro del módulo.',
                'example'     => "resources/views/sistema_control/\n├── asignaciones/\n├── devoluciones/\n└── portatiles/",
            ],
            [
                'icon'        => 'bi-signpost-2',
                'label'       => '5. Rutas en web.php',
                'path'        => 'routes/web.php',
                'image'       => '/assets/img/Referencia_comandos/Controlador_ejecutado.jpg',
                'description' => 'Registrar las rutas del módulo agrupadas bajo su prefijo y name.',
                'example'     => "Route::prefix('nombre-modulo')\n    ->name('nombre-modulo.')\n    ->middleware(['auth'])\n    ->group(function () {\n        Route::get('/', [NombreModuloController::class, 'index']);\n    });",
            ],
            [
                'icon'        => 'bi-shield-lock',
                'label'       => '6. Permisos y Accesos',
                'path'        => 'Base de datos (user_app_access)',
                'image'       => '/assets/img/Referencia_comandos/Comando_ejecutado.jpg',
                'description' => 'Asegúrate de que tu usuario tenga rol de Administrador en `user_app_access` para visualizar el módulo.',
                'is_alert'    => true,
            ],
        ],
    ],

    'layout_navigation' => [
        'title'       => 'Layout Propio y Navegación del Módulo',
        'description' => 'Integración segura al panel general del sistema.',
        'steps'       => [
            [
                'icon'        => 'bi-layout-sidebar',
                'label'       => '1. Extender el Navbar y Crear Layout del Módulo',
                'path'        => 'resources/views/layouts/modulo.blade.php',
                'image'       => '',
                'description' => 'El layout del módulo debe extender de app.blade.php.',
            ],
            [
                'icon'        => 'bi-compass',
                'label'       => '2. Registro en navigation.blade.php',
                'path'        => 'resources/views/navigation.blade.php',
                'image'       => '',
                'description' => 'Registra el módulo como un enlace en el menú, validado con permisos.',
                'example'     => "@if(\$hasAcceso)\n    <a href=\"{{ route('modulo.index') }}\">Link</a>\n@endif",
            ],
        ],
    ],
];