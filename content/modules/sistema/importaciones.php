<?php

declare(strict_types=1);

return [
    'category'         => 'sistema',
    'category_label'   => 'Módulos del Sistema',
    'template'         => 'modules/reference.twig',
    'nav'              => 'Importaciones',
    'title'            => 'Gestión de Importaciones Masivas',
    'tag'              => 'Sistema',
    'summary'          => 'Servicio centralizado para la carga, validación y procesamiento de archivos presupuestales (CDP, CRP, OP).',
    'intro'            => 'Puerta de entrada de datos financieros al sistema. Implementa procesamiento en streaming para eficiencia de memoria, validación de integridad y trazabilidad auditable.',
    
    // Lista de funcionalidades clave
    'features'         => [
        [
            'icon'  => 'bi-cloud-upload',
            'title' => 'Carga en Streaming',
            'text'  => 'Procesamiento de archivos masivos sin bloquear recursos del servidor.',
        ],
        [
            'icon'  => 'bi-check2-circle',
            'title' => 'Validación Estricta',
            'text'  => 'Control de calidad de datos previo a la persistencia.',
        ],
        [
            'icon'  => 'bi-journal-check',
            'title' => 'Auditoría integrada',
            'text'  => 'Conexión automática con el monitor de auditoría para registro de resultados.',
        ],
    ],

    // Navegación jerárquica y conexiones
    'related_modules' => [
        [
            'label'       => 'Auditoría de Importaciones',
            'slug'        => 'auditoria-importaciones', 
            'description' => 'Sistema de trazabilidad para verificar resultados de las cargas masivas.',
        ],
        [
            'label'       => 'Planeación',
            'slug'        => 'planeacion_uso', 
            'description' => 'Módulo central para la gestión financiera y seguimiento presupuestal.',
        ],
    ],
];