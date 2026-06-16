<?php

declare(strict_types=1);

return [
    'category'         => 'sistema',
    'category_label'   => 'Módulos del Sistema',
    'template'         => 'modules/reference.twig',
    'nav'              => 'Presupuesto General',
    'title'            => 'Vistas Jerárquicas CDP/CRP/OP',
    'tag'              => 'Core',
    'summary'          => 'Implementación de la navegación financiera jerárquica con filtros dinámicos y persistencia de estado.',
    'intro'            => 'Documentación técnica de la estructura de vistas que permite la trazabilidad completa del gasto público. El sistema permite filtrar grandes volúmenes de datos (más de 4,600 OPs) manteniendo la coherencia jerárquica entre certificados, compromisos y órdenes de pago.',
    
    'features'         => [
        [
            'icon'  => 'bi-filter-square',
            'title' => 'Filtrado Dinámico',
            'text'  => 'Filtros backend para CDP, CRP y OP que permiten búsquedas parciales y gestión de fuentes de financiación.',
        ],
        [
            'icon'  => 'bi-arrow-left-right',
            'title' => 'Navegación Jerárquica',
            'text'  => 'Flujo bidireccional: CDP → CRP → OP, facilitando auditorías de ejecución presupuestal.',
        ],
        [
            'icon'  => 'bi-palette',
            'title' => 'UX por Módulo',
            'text'  => 'Código de colores institucional (Naranja: CDP, Morado: CRP, Azul: OP) para rápida identificación.',
        ],
    ],

    'related_modules' => [
        [
            'label'       => 'Viáticos',
            'slug'        => 'viaticos', 
            'description' => 'Módulo especializado que reutiliza esta estructura jerárquica aplicando filtros de objeto de gasto.',
        ],
        [
            'label'       => 'Importaciones',
            'slug'        => 'importaciones', 
            'description' => 'Servicio que alimenta la base de datos de estos registros financieros.',
        ],
    ],
];
