<?php

declare(strict_types=1);

return [
    'category'        => 'sistema',
    'category_label'  => 'Módulos del Sistema',
    'template'        => 'modules/reference.twig',
    'nav'             => 'Ciudad Verde',
    'title'           => 'Módulo Ciudad Verde',
    'tag'             => 'Sistema',
    'summary'         => 'Módulo central del sistema que orquesta los procesos operativos y se integra con el microservicio de almacén.',
    'intro'           => 'Ciudad Verde es el módulo principal del sistema. Gestiona los procesos operativos del proyecto e integra los demás módulos y microservicios dentro de un flujo unificado. Es el punto de entrada para las operaciones del día a día.',
    'features'        => [
        [
            'icon'  => 'bi-diagram-3',
            'title' => 'Orquestación de módulos',
            'text'  => 'Centraliza la comunicación y el flujo de datos entre los distintos módulos del sistema.',
        ],
        [
            'icon'  => 'bi-boxes',
            'title' => 'Gestión de recursos',
            'text'  => 'Administra los recursos físicos y operativos asociados al proyecto Ciudad Verde.',
        ],
        [
            'icon'  => 'bi-plug',
            'title' => 'Integración con microservicios',
            'text'  => 'Se conecta con el microservicio de Almacén para gestión de inventario y activos.',
        ],
    ],
    'related_modules' => [
        [
            'label'       => 'Microservicio Almacén',
            'slug'        => 'almacen',
            'description' => 'Gestión de inventario y activos dentro del contexto del módulo Ciudad Verde.',
        ],
    ],
    'resources'       => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
