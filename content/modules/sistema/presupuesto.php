<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Presupuesto',
    'title'          => 'Sistema de Presupuesto',
    'tag'            => 'Financiero',
    'summary'        => 'Gestión integral de los procesos presupuestarios, desde solicitudes de CDP hasta el seguimiento de órdenes de pago.',
    'intro'          => 'El Sistema de Presupuesto opera como un módulo independiente que ofrece herramientas especializadas para el control financiero. Gestiona de manera integral todos los procesos presupuestarios, desde solicitudes de CDP hasta el seguimiento de órdenes de pago, e incluye control avanzado de usuarios y permisos.',
    'features'       => [
        [
            'icon'  => 'bi-file-earmark-text',
            'title' => 'Certificados CDP',
            'text'  => 'Disponibilidad Presupuestal. Gestiona y supervisa los Certificados de Disponibilidad Presupuestal de manera eficiente.',
        ],
        [
            'icon'  => 'bi-briefcase',
            'title' => 'Registros CRP',
            'text'  => 'Compromisos Presupuestales. Administra los Certificados de Registro Presupuestal y sus compromisos asociados.',
        ],
        [
            'icon'  => 'bi-cash-stack',
            'title' => 'Órdenes de Pago',
            'text'  => 'Gestión de Pagos. Controla y procesa las órdenes de pago del sistema presupuestario.',
        ],
        [
            'icon'  => 'bi-people',
            'title' => 'Gestión de Usuarios',
            'text'  => 'Control de Accesos. Administra usuarios, roles y permisos específicos del módulo de presupuesto.',
        ],
        [
            'icon'  => 'bi-person-badge',
            'title' => 'Solicitudes de Rol',
            'text'  => 'Gestión de Permisos. Revisa y aprueba las solicitudes de cambio de rol dentro del módulo.',
        ],
        [
            'icon'  => 'bi-bar-chart-steps',
            'title' => 'SENNOVA',
            'text'  => 'Sistema de Investigación. Accede a las funcionalidades específicas de SENNOVA y gestión de proyectos.',
        ],
    ],
    'architecture_docs' => [
        [
            'title'       => 'Estructura Frontend (Tailwind CSS y Blade)',
            'description' => 'La interfaz del Dashboard está construida utilizando el sistema de utilidades de Tailwind CSS integrado en plantillas de Blade. Presenta un grid responsivo para las tarjetas de navegación, sombras suaves y botones estilizados con colores semánticos. El Hero/Banner superior destaca con un diseño inmersivo en verde institucional y tipografía clara.',
        ],
        [
            'title'       => 'Arquitectura Modular Backend (Laravel)',
            'description' => 'El sistema opera como un "módulo independiente" (como se indica en la UI). A nivel de Laravel, esto implica una separación limpia de rutas (ej. prefijo `/presupuesto`), controladores dedicados por dominio (CdpController, CrpController, OrdenPagoController) y modelos Eloquent aislados del sistema académico principal para mantener la integridad de la gestión financiera.',
        ],
        [
            'title'       => 'Sistema de Roles y Seguridad',
            'description' => 'El módulo cuenta con un ecosistema propio de seguridad. En lugar de depender exclusivamente de un panel global, incluye módulos internos de "Gestión de Usuarios" y "Solicitudes de Rol", permitiendo a los administradores financieros delegar responsabilidades, aprobar cambios de rol y garantizar que procesos críticos como la emisión de CDP u OP estén restringidos.',
        ]
    ],
    'resources' => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
        [
            'label' => 'Guía completa: Planeación y su Uso',
            'url'   => '/planeacion-uso', 
        ],
    

    ],
];
