<?php

declare(strict_types=1);

return [
    'category'         => 'sistema',
    'category_label'   => 'Módulos del Sistema',
    'template'         => 'modules/reference.twig',
    'nav'              => 'Completar Info',
    'title'            => 'Sistema de Completar Información',
    'tag'              => 'Gestión Curricular',
    'summary'          => 'Herramienta de detección y gestión de campos faltantes en diseños, competencias y RAPs "Resultados de Aprendizaje" .',
    'intro'            => 'Funcionalidad integral que replica la lógica de validación legacy para asegurar la calidad de los datos curriculares. Permite identificar registros incompletos, visualizar campos obligatorios faltantes y gestionar su actualización mediante una interfaz intuitiva.',
    
    'features'         => [
        [
            'icon'  => 'bi-search',
            'title' => 'Detección Inteligente',
            'text'  => 'Identificación automática de campos obligatorios faltantes en Diseños, Competencias y RAPs"Resultados de Aprendizaje" .',
        ],
        [
            'icon'  => 'bi-speedometer2',
            'title' => 'Dashboard de Control',
            'text'  => 'Visualización de estados pendientes y métricas de avance en tiempo real con filtros avanzados.',
        ],
        [
            'icon'  => 'bi-pencil-square',
            'title' => 'Validación Visual',
            'text'  => 'Interfaz con marcado visual (clase campo-faltante) y feedback inmediato para agilizar la captura de datos.',
        ],
    ],

    'related_modules' => [
        [
            'label'       => 'Gestor Curricular',
            'slug'        => 'gestor-curricular', 
            'description' => 'Módulo central de administración de programas y competencias.',
        ],
        [
            'label'       => 'Importaciones',
            'slug'        => 'importaciones', 
            'description' => 'Carga de datos masivos que nutren los diseños curriculares.',
        ],
    ],
];