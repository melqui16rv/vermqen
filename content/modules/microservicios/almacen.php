<?php

declare(strict_types=1);

return [
    'category'        => 'microservicios',
    'category_label'  => 'Microservicios',
    'template'        => 'modules/reference.twig',
    'nav'             => 'Almacén',
    'title'           => 'Microservicio Almacén',
    'tag'             => 'Microservicio',
    'summary'         => 'Gestión de inventario y fichas técnicas para la dotación del SENA Ciudad Verde Soacha, con control exhaustivo de placas y ubicaciones.',
    'intro'           => 'El microservicio de Almacén centraliza el control de la dotación y activos del modulo Ciudad Verde. Permite registrar elementos (con o sin placa), escanear códigos mediante cámara o escáner manual, y mapear el mobiliario asignándolo a pisos y ambientes específicos. Además, ofrece estadísticas en tiempo real sobre el progreso de clasificación.',
    'features'        => [
        [
            'icon'  => 'bi-upc-scan',
            'title' => 'Registro y escaneo de placas',
            'text'  => 'Captura de activos mediante escáner, cámara o entrada manual, clasificando los elementos entre aquellos con placa y sin placa.',
        ],
        [
            'icon'  => 'bi-building-check',
            'title' => 'Asignación por ambientes',
            'text'  => 'Mapeo estructurado de la dotación, ubicando cada elemento en su piso y espacio físico exacto dentro de la sede.',
        ],
        [
            'icon'  => 'bi-pie-chart',
            'title' => 'Estadísticas en tiempo real',
            'text'  => 'Panel de control con el resumen del progreso de asignación, mostrando artículos mapeados, faltantes y un desglose por ambiente.',
        ],
        [
            'icon'  => 'bi-file-earmark-spreadsheet',
            'title' => 'Fichas técnicas y reportes',
            'text'  => 'Gestión de fichas técnicas, registro fotográfico de los espacios y exportación consolidada del inventario a formato CSV.',
        ],
    ],
    'related_modules' => [
        [
            'label'       => 'Módulo Ciudad Verde',
            'slug'        => 'ciudad-verde',
            'description' => 'Módulo principal que consume este microservicio para gestión operativa de activos.',
        ],
    ],
    'architecture_docs' => [
        [
            'title'       => 'Arquitectura del Microservicio Integrado',
            'description' => 'Almacén opera como un microservicio dependiente del módulo principal **Ciudad Verde**. Por ello, mantiene estrictamente la estructura de carpetas de su módulo padre: sus controladores residen bajo `app/Http/Controllers/CiudadVerde/Almacen`, sus modelos en `app/Models/CiudadVerde/Almacen` y sus vistas en `resources/views/ciudad_verde/almacen`. Esta práctica garantiza que los microservicios mantengan la cohesión del dominio al que pertenecen sin fragmentar el monolito modular.',
        ],
        [
            'title'       => 'Procesamiento de Inventario en Tiempo Real',
            'description' => 'A nivel de lógica backend, el microservicio está optimizado para capturar entradas rápidas de hardware (cámaras o escáneres USB) y clasificar instantáneamente los activos (con placa y sin placa), mapeando la base de datos de elementos físicos a ubicaciones jerárquicas (Sede -> Piso -> Ambiente) y alimentando los gráficos de progreso en tiempo real.',
        ]
    ],
    'resources'       => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
