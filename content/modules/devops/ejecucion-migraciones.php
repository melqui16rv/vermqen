<?php

declare(strict_types=1);

return [
    'category'       => 'devops',
    'category_label' => 'DevOps & Entorno',
    'template'       => 'modules/manual.twig',
    'nav'            => 'Migraciones',
    'title'          => 'Ejecución de Migraciones',
    'tag'            => 'DevOps',
    'summary'        => 'Guía para ejecutar, revertir y gestionar el versionado del esquema de base de datos del proyecto.',
    'intro'          => 'Las migraciones permiten versionar el esquema de la base de datos junto al código fuente. Este módulo cubre los comandos esenciales, el orden correcto de ejecución y las buenas prácticas para entornos de desarrollo y producción.',
    'pillars'        => [
        [
            'icon'  => 'bi-database-fill-up',
            'title' => 'Migraciones limpias',
            'text'  => 'Siempre ejecutar sobre una base de datos actualizada y con un respaldo previo en producción.',
        ],
        [
            'icon'  => 'bi-arrow-counterclockwise',
            'title' => 'Rollback seguro',
            'text'  => 'Revertir cambios con rollback en caso de error durante el deploy, sin pérdida de datos.',
        ],
        [
            'icon'  => 'bi-table',
            'title' => 'Estado del esquema',
            'text'  => 'Verificar el estado actual de migraciones antes de aplicar cambios nuevos.',
        ],
    ],
    'workflow'       => [
        [
            'step'    => '1. Verificar estado',
            'detail'  => 'Revisar qué migraciones están pendientes antes de aplicar cualquier cambio.',
            'command' => 'php artisan migrate:status',
        ],
        [
            'step'    => '2. Ejecutar migraciones pendientes',
            'detail'  => 'Aplicar todas las migraciones que aún no han sido ejecutadas.',
            'command' => 'php artisan migrate',
        ],
        [
            'step'    => '3. Migrar con datos semilla',
            'detail'  => 'Ejecutar migraciones y poblar la BD con datos iniciales (solo en desarrollo).',
            'command' => 'php artisan migrate --seed',
        ],
        [
            'step'    => '4. Rollback del último lote',
            'detail'  => 'Revertir el último lote de migraciones aplicadas si algo salió mal.',
            'command' => 'php artisan migrate:rollback',
        ],
        [
            'step'    => '5. Reset completo (solo desarrollo)',
            'detail'  => 'Borrar y recrear todo el esquema desde cero. NUNCA usar en producción.',
            'command' => 'php artisan migrate:fresh --seed',
        ],
        [
            'step'    => '6. Migración de un módulo específico',
            'detail'  => 'Como las migraciones están organizadas en carpetas por módulo, para migrar uno desde cero debes usar el flag --path indicando la ruta de la carpeta del módulo.',
            'command' => 'php artisan migrate --path=database/migrations/NombreModulo',
        ],
        [
            'step'    => '7. Reset y migración de un módulo (Refresh)',
            'detail'  => 'Para revertir (rollback) y volver a ejecutar desde cero únicamente las migraciones de un módulo en específico, usa el comando migrate:refresh con el flag --path.',
            'command' => 'php artisan migrate:refresh --path=database/migrations/NombreModulo',
        ],
    ],
    'refresh_command' => [
        'title'       => 'Ejecución de migrate:fresh (Reset Completo de la base de datos)',
        'description' => 'El comando `migrate:fresh` elimina **todas las tablas** de la base de datos y recrea el esquema desde cero aplicando todas las migraciones disponibles. Es equivalente a ejecutar `php artisan migrate:drop` seguido de `php artisan migrate`.',
        'steps'       => [
            [
                'icon'        => 'bi-backspace-fill',
                'label'       => '1. ¿Qué hace exactamente?',
                'path'        => 'Terminal',
                'description' => 'Elimina todo el esquema (tablas, índices, vistas) y ejecuta nuevamente el registro de migraciones desde cero. Si utilizas seeders, también se ejecutarán.',
                'example'     => "php artisan migrate:fresh --seed",
            ],
            [
                'icon'        => 'bi-exclamation-triangle-fill',
                'label'       => '2. ADVERTENCIA DE SEGURIDAD',
                'path'        => '',
                'description' => '**NO USAR EN PRODUCCIÓN.** Este comando borra datos permanentemente. Solo es seguro en entornos de desarrollo o pruebas donde no hay información crítica.',
            ],
            [
                'icon'        => 'bi-file-earmark-text',
                'label'       => '3. Script Recomendado para Desarrollo',
                'path'        => 'Terminal',
                'description' => 'Para limpiar la base de datos local y volver a un estado inicial de forma rápida y segura, usa el siguiente script que incluye el seeder para dejar usuarios y roles funcionales.',
                'example'     => "php artisan migrate:fresh --seed",
            ],
        ],
        'workflow'       => [
        [
            'step'    => '1. Verificar estado',
            'detail'  => 'Revisar qué migraciones están pendientes antes de aplicar cualquier cambio.',
            'command' => 'php artisan migrate:status',
        ],
        [
            'step'    => '2. Ejecutar migraciones pendientes',
            'detail'  => 'Aplicar todas las migraciones que aún no han sido ejecutadas.',
            'command' => 'php artisan migrate',
        ],
        [
            'step'    => '3. Migrar con datos semilla',
            'detail'  => 'Ejecutar migraciones y poblar la BD con datos iniciales (solo en desarrollo).',
            'command' => 'php artisan migrate --seed',
        ],
        [
            'step'    => '4. Rollback del último lote',
            'detail'  => 'Revertir el último lote de migraciones aplicadas si algo salió mal.',
            'command' => 'php artisan migrate:rollback',
        ],
        [
            'step'    => '5. Reset completo (solo desarrollo)',
            'detail'  => 'Borrar y recrear todo el esquema desde cero. NUNCA usar en producción.',
            'command' => 'php artisan migrate:fresh --seed',
        ],
        [
            'step'    => '6. Migración de un módulo específico',
            'detail'  => 'Como las migraciones están organizadas en carpetas por módulo, para migrar uno desde cero debes usar el flag --path indicando la ruta de la carpeta del módulo.',
            'command' => 'php artisan migrate --path=database/migrations/NombreModulo',
        ],
        [
            'step'    => '7. Reset y migración de un módulo (Refresh)',
            'detail'  => 'Para revertir (rollback) y volver a ejecutar desde cero únicamente las migraciones de un módulo en específico, usa el comando migrate:refresh con el flag --path.',
            'command' => 'php artisan migrate:refresh --path=database/migrations/NombreModulo',
        ],
    ],
    ],
    'checklist'      => [
        'Se realizó un respaldo de la base de datos antes de aplicar en producción.',
        'Se revisó el estado con migrate:status y no hay conflictos.',
        'El .env apunta a la base de datos correcta del entorno.',
        'Las migraciones se probaron primero en el entorno local.',
        'No se usa migrate:fresh en producción bajo ningún caso.',
    ],
    'resources'      => [
        [
            'label' => 'Laravel Docs · Migrations',
            'url'   => 'https://laravel.com/docs/migrations',
        ],
        [
            'label' => 'Laravel Docs · Seeding',
            'url'   => 'https://laravel.com/docs/seeding',
        ],
    ],
];
