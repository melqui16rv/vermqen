<?php

declare(strict_types=1);

return [
    'category'         => 'devops',
    'category_label'   => 'DevOps & Entorno',
    'template'         => 'modules/reference.twig',
    'nav'              => 'Validación CDP-CRP-OP',
    'title'            => 'Bitácora: Validación de Datos Presupuestales',
    'tag'              => 'Troubleshooting',
    'summary'          => 'Informe técnico sobre la corrección de inconsistencias en la visualización de valores en la jerarquía CDP-CRP-OP.',
    'intro'            => 'Este documento registra la incidencia técnica donde los valores presupuestales mostraban $0 debido a inconsistencias entre los nombres de los campos en las vistas y el esquema real de la base de datos.',
    
    'features'         => [
        [
            'icon'  => 'bi-database-check',
            'title' => 'Estandarización de Campos',
            'text'  => 'Corrección de referencias: uso obligatorio de Valor_Actual para CDP/CRP y Valor_Neto para OPs.',
        ],
        [
            'icon'  => 'bi-diagram-3',
            'title' => 'Integridad Referencial',
            'text'  => 'Validación de relaciones consistentes entre documentos (CDP → CRP → OP).',
        ],
        [
            'icon'  => 'bi-bug',
            'title' => 'Resolución de Incidencia',
            'text'  => 'Depuración de vistas Blade para eliminar llamadas a campos inexistentes ($0).',
        ],
    ],

    'related_modules' => [
        [
            'label'       => 'Auditoría de Importaciones',
            'slug'        => 'auditoria-importaciones', 
            'description' => 'Sistema de trazabilidad de cargas masivas para prevenir inconsistencias de datos.',
        ],
        [
            'label'       => 'Planeación',
            'slug'        => 'planeacion_uso', 
            'description' => 'Módulo central de gestión financiera que utiliza estas relaciones presupuestales.',
        ],
    ],
];