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
