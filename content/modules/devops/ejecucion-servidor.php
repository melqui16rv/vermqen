<?php

declare(strict_types=1);

return [
    'category'       => 'devops',
    'category_label' => 'DevOps & Entorno',
    'template'       => 'modules/manual.twig',
    'nav'            => 'Ejecución Servidor',
    'title'          => 'Ejecución del Servidor de Desarrollo',
    'tag'            => 'DevOps',
    'summary'        => 'Pasos para levantar el entorno local de desarrollo con Laravel, Vite y los servicios dependientes.',
    'intro'          => 'Esta guía cubre el proceso completo para iniciar el servidor de desarrollo, incluyendo instalación de dependencias, configuración del entorno, y arranque simultáneo del backend Laravel y el compilador de assets Vite.',
    'pillars'        => [
        [
            'icon'  => 'bi-gear-fill',
            'title' => 'Requisitos previos',
            'text'  => 'PHP 8.2+, Composer, Node.js 18+, y la base de datos configurada y accesible.',
        ],
        [
            'icon'  => 'bi-terminal',
            'title' => 'Comandos claros',
            'text'  => 'Secuencia exacta de comandos para levantar backend y frontend en paralelo.',
        ],
        [
            'icon'  => 'bi-exclamation-triangle',
            'title' => 'Errores comunes',
            'text'  => 'Soluciones a los problemas más frecuentes al iniciar el entorno por primera vez.',
        ],
    ],
    'env_vars'       => [
        [
            'key'         => 'APP_NAME',
            'value'       => 'VERMQEN',
            'description' => 'Nombre de la aplicación mostrado en el sistema.',
            'required'    => true,
        ],
        [
            'key'         => 'APP_ENV',
            'value'       => 'local',
            'description' => 'Entorno activo: local | staging | production.',
            'required'    => true,
        ],
        [
            'key'         => 'APP_KEY',
            'value'       => 'base64:...',
            'description' => 'Clave de cifrado. Se genera con php artisan key:generate.',
            'required'    => true,
        ],
        [
            'key'         => 'APP_URL',
            'value'       => 'http://localhost:8000',
            'description' => 'URL base de la aplicación. Debe coincidir con el servidor activo.',
            'required'    => true,
        ],
        [
            'key'         => 'DB_CONNECTION',
            'value'       => 'mysql',
            'description' => 'Driver de base de datos: mysql | pgsql | sqlite.',
            'required'    => true,
        ],
        [
            'key'         => 'DB_HOST',
            'value'       => '127.0.0.1',
            'description' => 'Host del servidor de base de datos.',
            'required'    => true,
        ],
        [
            'key'         => 'DB_PORT',
            'value'       => '3306',
            'description' => 'Puerto de conexión (3306 para MySQL, 5432 para PostgreSQL).',
            'required'    => true,
        ],
        [
            'key'         => 'DB_DATABASE',
            'value'       => 'vermqen_db',
            'description' => 'Nombre exacto de la base de datos en el servidor.',
            'required'    => true,
        ],
        [
            'key'         => 'DB_USERNAME',
            'value'       => 'root',
            'description' => 'Usuario con permisos sobre la base de datos.',
            'required'    => true,
        ],
        [
            'key'         => 'DB_PASSWORD',
            'value'       => '(contraseña del usuario)',
            'description' => 'Contraseña del usuario de base de datos. No compartir en el repositorio.',
            'required'    => true,
        ],
        [
            'key'         => 'SESSION_DRIVER',
            'value'       => 'file',
            'description' => 'Almacenamiento de sesiones: file | database | redis.',
            'required'    => false,
        ],
        [
            'key'         => 'CACHE_STORE',
            'value'       => 'file',
            'description' => 'Driver de caché utilizado por la aplicación.',
            'required'    => false,
        ],
    ],
    'workflow'       => [
        [
            'step'    => '1. Instalar dependencias PHP',
            'detail'  => 'Instalar paquetes de Composer antes de la primera ejecución o tras un pull con cambios en composer.json.',
            'command' => 'composer install',
        ],
        [
            'step'    => '2. Configurar el entorno',
            'detail'  => 'Copiar el archivo de entorno de ejemplo y generar la clave de aplicación.',
            'command' => 'cp .env.example .env && php artisan key:generate',
        ],
        [
            'step'    => '3. Instalar dependencias JS',
            'detail'  => 'Instalar dependencias de Node para el compilador de assets.',
            'command' => 'npm install',
        ],
        [
            'step'    => '4. Ejecutar migraciones',
            'detail'  => 'Crear el esquema de base de datos y poblar con datos semilla.',
            'command' => 'php artisan migrate --seed',
        ],
        [
            'step'    => '5. Levantar el servidor Laravel',
            'detail'  => 'Iniciar el servidor de desarrollo en el puerto 8000.',
            'command' => 'php artisan serve',
        ],
        [
            'step'    => '6. Compilar assets en paralelo',
            'detail'  => 'En una segunda terminal, levantar Vite para CSS y JS en tiempo real.',
            'command' => 'npm run dev',
        ],
    ],
    'checklist'      => [
        'El archivo .env está configurado con credenciales correctas.',
        'La base de datos existe y es accesible desde la máquina local.',
        'Las migraciones fueron ejecutadas sin errores.',
        'El puerto 8000 está disponible (no lo usa otro proceso).',
        'Las variables APP_URL y DB_* están apuntando al entorno correcto.',
    ],
    'resources'      => [
        [
            'label' => 'Laravel Docs · Installation',
            'url'   => 'https://laravel.com/docs/installation',
        ],
        [
            'label' => 'Vite · Frontend Tooling',
            'url'   => 'https://vite.dev/',
        ],
    ],
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
                'icon'        => 'bi-signpost-2',
                'label'       => '4. Rutas en web.php',
                'path'        => 'routes/web.php',
                'description' => 'Registrar las rutas del módulo agrupadas bajo su prefijo y name, documentadas con un comentario separador que lleva el nombre del módulo.',
                'example'     => "// ── NombreModulo ──────────────────────────────────\nuse App\\Http\\Controllers\\NombreModulo\\NombreModuloController;\n\nRoute::prefix('nombre-modulo')\n     ->name('nombre-modulo.')\n     ->middleware(['auth'])\n     ->group(function () {\n         Route::get('/',        [NombreModuloController::class, 'index' ])->name('index');\n         Route::get('/crear',   [NombreModuloController::class, 'create'])->name('create');\n         Route::post('/',       [NombreModuloController::class, 'store' ])->name('store');\n         Route::get('/{id}',    [NombreModuloController::class, 'show'  ])->name('show');\n         Route::put('/{id}',    [NombreModuloController::class, 'update'])->name('update');\n         Route::delete('/{id}', [NombreModuloController::class, 'destroy'])->name('destroy');\n     });",
            ],
        ],
    ],
    'email_setup'    => [
        'title'       => 'Configuración de Correos y Creación de Usuario Local',
        'description' => 'Para el envío de correos y confirmación de cuentas en local, puedes configurar un servicio SMTP en el `.env` (como Mailtrap). Si prefieres evitar este paso y saltar la confirmación, puedes crear un usuario ya verificado directamente mediante consola interactiva (Tinker) sin crear archivos adicionales.',
        'steps'       => [
            [
                'icon'        => 'bi-envelope-at',
                'label'       => '1. Configuración de envío de correo en .env',
                'path'        => '.env',
                'description' => 'Configura las variables de entorno para conectarse a tu servicio SMTP local o de pruebas.',
                'example'     => "MAIL_MAILER=smtp\nMAIL_HOST=sandbox.smtp.mailtrap.io\nMAIL_PORT=2525\nMAIL_USERNAME=tu_usuario\nMAIL_PASSWORD=tu_contraseña\nMAIL_ENCRYPTION=tls\nMAIL_FROM_ADDRESS=\"hello@example.com\"\nMAIL_FROM_NAME=\"\${APP_NAME}\"",
            ],
            [
                'icon'        => 'bi-terminal-fill',
                'label'       => '2. Crear usuario verificado con Tinker',
                'path'        => 'Terminal',
                'description' => 'Ejecuta `php artisan tinker` para interactuar con la base de datos y crea un usuario con la fecha actual en `email_verified_at` para omitir la confirmación por correo.',
                'example'     => "php artisan tinker\n\nuse App\\Models\\User;\n\nUser::create([\n    'name' => 'Laura ',\n    'email' => 'rubianolaura779@gmail.com',\n    'password' => 'Admin123', // Usar bcrypt('Admin123') si el modelo no tiene el cast automático\n    'rol' => 'Admin',\n    'active' => true,\n    'email_verified_at' => now(),\n]);",
            ],
        ],
    ],
];
