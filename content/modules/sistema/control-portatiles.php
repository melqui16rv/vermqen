<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Control Portátiles',
    'title'          => 'Sistema de Control de Portátiles',
    'tag'            => 'Sistema',
    'summary'        => 'Gestión del inventario, préstamo y seguimiento de portátiles y equipos tecnológicos del proyecto.',
    'intro'          => 'El Sistema de Control de Portátiles gestiona el ciclo de vida completo de los equipos: inventario inicial, asignación, préstamos, devoluciones y estado técnico. Permite saber en todo momento dónde está cada equipo y quién es responsable.',
    'features'       => [
        [
            'icon'  => 'bi-laptop',
            'title' => 'Inventario de equipos',
            'text'  => 'Registro completo de portátiles con número de serie, estado y especificaciones técnicas.',
        ],
        [
            'icon'  => 'bi-arrow-left-right',
            'title' => 'Gestión de préstamos',
            'text'  => 'Control de asignaciones temporales con fecha de entrega, devolución esperada y responsable.',
        ],
        [
            'icon'  => 'bi-qr-code-scan',
            'title' => 'Trazabilidad completa',
            
            'text'  => 'Historial de movimientos por equipo: quién lo usó, cuándo y en qué estado fue devuelto.',
        ],
    ],
    'resources'      => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
