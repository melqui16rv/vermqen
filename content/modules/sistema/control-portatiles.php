<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Control Portátiles',
    'title'          => 'Sistema Control Portátiles',
    'tag'            => 'Sistema',
    'summary'        => 'Herramienta centralizada para la gestión de préstamos de portátiles a instructores, asegurando trazabilidad y control de inventario.',
    'intro'          => 'El módulo Sistema Control Portátiles fue desarrollado para administrar de manera organizada el préstamo de portátiles a instructores, garantizando trazabilidad, control de inventario y seguimiento de estados. Su objetivo es optimizar el flujo administrativo, ofreciendo un registro confiable de asignaciones y devoluciones junto con un historial completo para auditorías.',
    'features'       => [
        [
            'icon'  => 'bi-laptop',
            'title' => 'Portátiles',
            'text'  => 'CRUD completo para registrar, editar, consultar y eliminar portátiles. Incluye filtros por estado (Disponible, Asignado, En reparación, etc.) y paginador para facilitar la navegación en listados extensos.',
        ],
        [
            'icon'  => 'bi-person-check',
            'title' => 'Asignaciones',
            'text'  => 'Gestión de préstamos de portátiles a instructores. Permite seleccionar únicamente equipos disponibles, registrar fechas y responsables. Incluye filtros por usuario, estado y rango de fechas, además de paginador.',
        ],
        [
            'icon'  => 'bi-arrow-return-left',
            'title' => 'Devoluciones',
            'text'  => 'Registro de la devolución de portátiles, con campos para observaciones y responsable de recepción. Se implementan filtros por usuario, estado del equipo y fecha de devolución, junto con paginador.',
        ],
        [
            'icon'  => 'bi-clock-history',
            'title' => 'Historial',
            'text'  => 'Seguimiento detallado de cambios de estado de cada portátil. Permite consultar la trazabilidad completa del equipo, con filtros por tipo de estado y fechas, además de paginador.',
        ],
    ],
    'architecture_docs' => [
        [
            'title'       => 'Filtros Dinámicos y Paginación',
            'description' => 'Implementación de filtros dinámicos en cada sección para búsquedas rápidas y precisas. Paginación automática en listados para mejorar la experiencia de usuario y rendimiento del sistema administrativo.',
        ],
        [
            'title'       => 'Modelo de Datos y Seguridad (Roles/Permisos)',
            'description' => 'Relación robusta entre entidades (usuarios, portátiles, asignaciones, devoluciones, historial) mediante Eloquent ORM para mantener total consistencia en la base de datos. Está respaldado por una integración de roles y permisos para controlar estrictamente el acceso a las diferentes funcionalidades.',
        ],
        [
            'title'       => 'Dashboard y Métricas',
            'description' => 'Sección avanzada de reportes y dashboard que proporciona métricas clave en tiempo real: cantidad de portátiles disponibles, asignados y devueltos.',
        ]
    ],
    'resources'      => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv/vermqen-laravel',
        ],
    ],
];
