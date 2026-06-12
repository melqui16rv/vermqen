<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Presupuesto',
    'title'          => 'Módulo de Presupuesto',
    'tag'            => 'Sistema',
    'summary'        => 'Planificación, seguimiento y control del presupuesto del proyecto con reportes por centro de costo.',
    'intro'          => 'El módulo de Presupuesto permite la gestión integral de los recursos financieros del proyecto. Cubre desde la planeación inicial hasta el seguimiento en tiempo real del gasto por partida, facilitando la toma de decisiones con base en datos actualizados.',
    'features'       => [
        [
            'icon'  => 'bi-cash-stack',
            'title' => 'Planeación presupuestal',
            'text'  => 'Definición de partidas, montos asignados y distribución por centro de costo o área.',
        ],
        [
            'icon'  => 'bi-graph-up-arrow',
            'title' => 'Seguimiento de ejecución',
            'text'  => 'Monitoreo en tiempo real del gasto vs. el presupuesto aprobado con indicadores visuales.',
        ],
        [
            'icon'  => 'bi-file-earmark-bar-graph',
            'title' => 'Reportes y exportación',
            'text'  => 'Generación de reportes por período, área o partida con exportación a formatos estándar.',
        ],
    ],
    'resources'      => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
