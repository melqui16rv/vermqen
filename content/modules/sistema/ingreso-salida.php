<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Ingreso / Salida',
    'title'          => 'Módulo Ingreso y Salida',
    'tag'            => 'Sistema',
    'summary'        => 'Control y registro de ingresos y salidas de personas, equipos o activos dentro del sistema.',
    'intro'          => 'El módulo de Ingreso y Salida gestiona el registro de entradas y salidas de personas, equipos y activos. Permite llevar una trazabilidad completa de los movimientos dentro del proyecto con soporte para notificaciones y reportes.',
    'features'       => [
        [
            'icon'  => 'bi-door-open-fill',
            'title' => 'Registro de entradas',
            'text'  => 'Captura y validación del ingreso de personas o activos con marca de tiempo y responsable.',
        ],
        [
            'icon'  => 'bi-door-closed-fill',
            'title' => 'Registro de salidas',
            'text'  => 'Control de salidas con confirmación del estado de los activos al momento de la salida.',
        ],
        [
            'icon'  => 'bi-clock-history',
            'title' => 'Historial y trazabilidad',
            'text'  => 'Consulta de historial completo con filtros por fecha, responsable y tipo de movimiento.',
        ],
    ],
    'resources'      => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
