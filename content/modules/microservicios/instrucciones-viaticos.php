<?php

declare(strict_types=1);

return [
    'category'         => 'microservicios',
    'category_label'   => 'Arquitectura de Microservicios',
    'template'         => 'modules/manual.twig',
    'nav'              => 'Módulo Viáticos',
    'title'            => 'Implementación del Módulo de Viáticos',
    'tag'              => 'Microservicios',
    'summary'          => 'Guía paso a paso para la duplicación y adaptación del módulo de presupuesto hacia la funcionalidad específica de Viáticos.',
    'intro'            => 'Este documento detalla la migración y creación del módulo de Viáticos dentro del ecosistema de microservicios, asegurando la integridad de las consultas financieras mediante filtrado automático y una interfaz diferenciada.',
    'pillars'          => [
        [
            'icon'  => 'bi-files',
            'title' => 'Estructura de Vistas',
            'text'  => 'Replicación jerárquica de la estructura de presupuesto general para CDP, CRP y OP.',
        ],
        [
            'icon'  => 'bi-code-slash',
            'title' => 'Controladores Específicos',
            'text'  => 'Lógica de filtrado centralizada en el namespace \App\Http\Controllers\Presupuesto\planeacion\Viaticos.',
        ],
        [
            'icon'  => 'bi-palette',
            'title' => 'Interfaz Adaptativa',
            'text'  => 'Uso de paleta púrpura (#8b5cf6) y gráficas Chart.js para distinguir el módulo.',
        ],
    ],
    'workflow'         => [
        [
            'step'    => '1. Clonación de estructura',
            'detail'  => 'Duplicar vistas del módulo General a la carpeta Viáticos y crear subdirectorios.',
            'command' => 'mkdir -p viaticos/{cdp,crp,op} && cp -r general/* viaticos/',
        ],
        [
            'step'    => '2. Implementación de controladores',
            'detail'  => 'Crear controladores con filtros exclusivos: Objeto LIKE %VIATICOS%.',
            'command' => 'php artisan make:controller Viaticos/DashboardController',
        ],
        [
            'step'    => '3. Registro de rutas',
            'detail'  => 'Definir el nuevo grupo de rutas dentro del prefijo de viáticos.',
            'command' => 'web.php -> Route::prefix(\'viaticos\')...',
        ],
        [
            'step'    => '4. Integración de gráficas',
            'detail'  => 'Implementar Chart.js para visualización de estado de presupuesto y ejecución OP.',
            'command' => 'view -> @push(\'scripts\')...',
        ],
        [
            'step'    => '5. Verificación de integridad',
            'detail'  => 'Validar consultas vía terminal y limpiar caché de rutas.',
            'command' => 'php artisan route:list --name=viaticos',
        ],
    ],
    'checklist'        => [
        'Los filtros de búsqueda LIKE %VIATICOS% están aplicados en todos los modelos.',
        'La navegación jerárquica entre CDP, CRP y OP funciona correctamente.',
        'Los colores principales de las vistas han sido cambiados de verde a morado.',
        'El sistema de caché fue limpiado (route:clear / config:clear).',
        'Las estadísticas financieras coinciden con los datos de la base de datos.',
    ],
    'resources'        => [
        [
            'label' => 'Documentación Base (Presupuesto General)',
            'url'   => '/presupuesto',
        ],
        [
            'label' => 'Modulo Viáticos',
            'url'   => '/viaticos',
        ],
    ],
];