<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Gestor Curricular',
    'title'          => 'Gestor Curricular',
    'tag'            => 'Sistema',
    'summary'        => 'Panel de administración del diseño curricular para la gestión de programas formativos, competencias y resultados de aprendizaje.',
    'intro'          => 'El Gestor Curricular permite administrar la estructura académica del sistema de forma integral. Centraliza el estado de completitud de los diseños curriculares mediante un flujo de auditoría informativa que valida campos obligatorios antes de su aprobación.',
    
    // Mapeo exacto de los bloques del Dashboard Principal (Captura 1)
    'features'       => [
        [
            'icon'  => 'bi-journal-bookmark-fill', // Icono representativo para Diseños Curriculares
            'title' => 'Diseños Curriculares',
            'text'  => 'Visualización, búsqueda y control del total de diseños curriculares registrados en el sistema.',
        ],
        [
            'icon'  => 'bi-check-circle-fill', // Icono check de Competencias
            'title' => 'Competencias',
            'text'  => 'Administración de competencias específicas asociadas a cada programa formativo.',
        ],
        [
            'icon'  => 'bi-box-seam', // Icono del paquete/bloque de RAPs
            'title' => 'Resultados de Aprendizaje (RAPs)',
            'text'  => 'Seguimiento detallado de los Resultados de Aprendizaje Previstos por competencia.',
        ],
        [
            'icon'  => 'bi-exclamation-triangle-fill', // Icono de Requieren Atención / Alerta naranja
            'title' => 'Estado de la Información',
            'text'  => 'Mecanismo de control para identificar diseños, competencias o RAPs con campos faltantes.',
        ],
    ],

    // --- ESPECIFICACIONES TÉCNICAS PARA DESARROLLADORES (Basado en la UI) ---
    'developer_docs' => [
        'ui_components' => [
            'navbar_context' => 'Módulo integrado en el Header Principal bajo "Aplicaciones".',
            'sub_nav_tabs'   => ['Dashboard', 'Diseños Curriculares', 'Competencias', 'RAPs', 'Completar Información']
        ],

        // Filtros de Búsqueda implementados en los formularios (Capturas 2, 3 y 4)
        'search_filters' => [
            'disenos_curriculares' => [
                'input_principal' => 'Buscar programa (Código o nombre del programa...)',
                'select_filters'  => ['Nivel Académico (Todos los niveles)', 'Línea Tecnológica (Todas las líneas)', 'Tipo Duración (Todos los tipos)'],
                'advanced_toggle' => 'Filtros avanzados'
            ],
            'competencias' => [
                'input_principal' => 'Buscar competencia (Nombre o código de competencia...)',
                'advanced_toggle' => 'Filtros avanzados'
            ],
            'raps' => [
                'input_principal' => 'Buscar RAP (Nombre o código de RAP...)',
                'advanced_toggle' => 'Filtros avanzados'
            ],
            'completar_informacion' => [
                'select_seccion'  => 'Mostrar sección (Todas las secciones)',
                'input_busqueda'  => 'Búsqueda general (Nombre, código...)',
                'select_campos'   => 'Campos faltantes (Cualquier cantidad)'
            ]
        ],

        // Lógica del Algoritmo de Auditoría Informativa (Capturas 1 y 5)
        'audit_system_logic' => [
            'widgets_evaluated' => [
                'diseños_incompletos'     => 'Evalúa registros en base de datos con campos obligatorios nulos o sin competencias vinculadas.',
                'competencias_incompletas' => 'Filtra competencias que carecen de código formal o descripción estructurada.',
                'raps_incompletos'         => 'Sanea resultados de aprendizaje huérfanos o sin asociación clara a una competencia.'
            ],
            'success_state' => 'Cuando el contador de las 3 entidades llega a cero (0), el sistema renderiza el componente visual de éxito: "¡Excelente! No se encontraron registros con información faltante en ninguna sección. Todos los registros están completos. ¡Toda la información está completa!".'
        ],

        // Arquitectura de Enrutamiento Presupuestal vinculada (Código de rutas)
        'routing_reference' => [
            'prefix'     => 'planeacion',
            'group_name' => 'presupuesto.planeacion.',
            'endpoints'  => [
                [
                    'uri'        => '/planeacion',
                    'method'     => 'GET',
                    'action'     => 'PlaneacionDashboardController@index',
                    'route_name' => 'dashboard'
                ],
                [
                    'uri'        => '/planeacion/general/cdp',
                    'method'     => 'GET',
                    'action'     => 'General\CdpController@index',
                    'route_name' => 'general.cdp.index'
                ],
                [
                    'uri'        => '/planeacion/general/cdp/{numeroDocumento}/detalle',
                    'method'     => 'GET',
                    'action'     => 'General\CdpController@show',
                    'route_name' => 'general.cdp.show'
                ],
                [
                    'uri'        => '/planeacion/general/crp/cdp/{codigoCdp}',
                    'method'     => 'GET',
                    'action'     => 'General\CrpController@byCdp',
                    'route_name' => 'general.crp.byCdp'
                ],
                [
                    'uri'        => '/planeacion/general/op/crp/{codigoCrp}',
                    'method'     => 'GET',
                    'action'     => 'General\OpController@byCrp',
                    'route_name' => 'general.op.byCrp'
                ]
            ]
        ],

        // Guía del entorno de desarrollo local (Basado en tu stack del workspace)
        'environment_setup' => [
            'requirements' => ['PHP >= 8.2', 'Laravel Framework', 'Tailwind CSS', 'Twig / Blade Engine', 'XAMPP / MySQL'],
            'commands'     => [
                'Iniciar Servidor Local' => 'php -S localhost:8085 -t public', // Ajustado al puerto visible en tus pestañas de desarrollo
                'Limpiar caché de rutas' => 'php artisan route:clear',
                'Refrescar Tablas UI'    => 'Acción del botón "Refrescar" que ejecuta la re-evaluación síncrona del estado de los campos.'
            ]
        ]
    ],

    // Recursos y Control de Versiones
    'resources'       => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
