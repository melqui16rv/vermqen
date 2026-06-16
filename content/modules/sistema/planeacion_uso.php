<?php

declare(strict_types=1);

return [
    'category'         => 'sistema',
    'category_label'   => 'Módulos del Sistema',
    'template'         => 'modules/reference.twig',
    'nav'              => 'Planeación',
    'title'            => 'Planeación y su Uso',
    'tag'              => 'Sistema',
    'summary'          => 'Gestión integral del presupuesto institucional, incluyendo el seguimiento a CDPs, CRPs y Órdenes de Pago (OPs) con flujo jerárquico.',
    'intro'            => 'El módulo de Planeación es la herramienta central para el control financiero. Permite gestionar tanto el presupuesto general como el de viáticos, proporcionando visualizaciones en tiempo real, filtros inteligentes y una navegación jerárquica que facilita el seguimiento desde la asignación del CDP hasta la ejecución del pago.',
    'features'         => [
        [
            'icon'  => 'bi-bar-chart-line',
            'title' => 'Dashboard Interactivo',
            'text'  => 'Visualización del estado del presupuesto, consumos y saldos disponibles mediante gráficas y tarjetas informativas.',
        ],
        [
            'icon'  => 'bi-hierarchy',
            'title' => 'Navegación Jerárquica',
            'text'  => 'Seguimiento trazable: CDP (Certificado) → CRPs (Compromisos) → OPs (Órdenes de Pago).',
        ],
        [
            'icon'  => 'bi-funnel',
            'title' => 'Filtros Inteligentes',
            'text'  => 'Búsqueda en tiempo real, filtrado por fuentes de financiación y paginación para grandes volúmenes de datos.',
        ],
    ],
    'related_modules' => [
        [
            'label'       => 'Configuración de Entorno',
            'slug'        => 'configuracion-env', // Asegúrate de que este slug sea el mismo que el del archivo que creamos en devops
            'description' => 'Guía esencial para configurar las variables de conexión a base de datos y servicios de correo necesarias para este módulo.',
        ],
    ],
    'related_modules' => [
        [
            'label'       => 'Configuración de Entorno',
            'slug'        => 'configuracion-env', 
            'description' => 'Guía esencial para configurar las variables de conexión.',
        ],
        [
            'label'       => 'Presupuesto',
            'slug'        => 'presupuesto', 
            'description' => 'Gestión detallada de los rubros presupuestales.',
        ],
    ],
    
];