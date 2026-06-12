<?php

declare(strict_types=1);

return [
    'category'        => 'microservicios',
    'category_label'  => 'Microservicios',
    'template'        => 'modules/reference.twig',
    'nav'             => 'Almacén',
    'title'           => 'Microservicio Almacén',
    'tag'             => 'Microservicio',
    'summary'         => 'Microservicio independiente para la gestión de inventario y activos dentro del módulo Ciudad Verde.',
    'intro'           => 'El microservicio de Almacén es una unidad autónoma que provee la lógica de gestión de inventario al módulo Ciudad Verde. Expone una API REST que permite consultar, registrar y actualizar el estado de activos, herramientas y materiales del proyecto.',
    'features'        => [
        [
            'icon'  => 'bi-box-seam',
            'title' => 'Gestión de inventario',
            'text'  => 'CRUD completo de activos, herramientas y materiales con control de stock en tiempo real.',
        ],
        [
            'icon'  => 'bi-arrow-repeat',
            'title' => 'Movimientos de almacén',
            'text'  => 'Registro de entradas, salidas, traslados y ajustes de inventario con trazabilidad.',
        ],
        [
            'icon'  => 'bi-hdd-network',
            'title' => 'API REST independiente',
            'text'  => 'Expone endpoints REST que pueden ser consumidos por otros módulos o sistemas externos.',
        ],
    ],
    'related_modules' => [
        [
            'label'       => 'Módulo Ciudad Verde',
            'slug'        => 'ciudad-verde',
            'description' => 'Módulo principal que consume este microservicio para gestión operativa de activos.',
        ],
    ],
    'resources'       => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
