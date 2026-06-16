<?php

declare(strict_types=1);

return [
    'category'       => 'microservicios',
    'category_label' => 'Microservicios',
    'template'       => 'modules/manual.twig',
    'nav'            => 'Implementación',
    'title'          => 'Implementación de Microservicios',
    'tag'            => 'Arquitectura',
    'summary'        => 'Guía para implementar y estructurar microservicios independientes.',
    'intro'          => 'Lineamientos técnicos y estructurales para desarrollar microservicios desacoplados que interactúen correctamente con los módulos principales.',
    'microservice_guide' => [
        'title'       => 'Implementación de Microservicios',
        'description' => 'Si el módulo que estás creando es un microservicio (como Almacén) diseñado para ser consumido por un módulo principal (como Ciudad Verde), el enfoque de implementación cambia ligeramente.',
        'steps'       => [
            [
                'icon'        => 'bi-diagram-3',
                'label'       => '1. Estructura de Carpetas por Dominio',
                'path'        => 'Controladores / Modelos / Vistas',
                'description' => 'Si el microservicio pertenece a un módulo, debe conservar la estructura de carpetas de ese módulo. Sus Controladores, Modelos y Vistas deben alojarse como subcarpetas dentro del directorio del módulo principal (ej. `app/Http/Controllers/CiudadVerde/Almacen` y `resources/views/ciudad_verde/almacen`), garantizando la cohesión del dominio.',
            ],
            [
                'icon'        => 'bi-router',
                'label'       => '2. Exposición de Rutas',
                'path'        => 'routes/api.php o web.php',
                'description' => 'Dependiendo de si el microservicio devuelve vistas o solo JSON, regístralo en el archivo de rutas correspondiente y bajo un prefijo único (ej. `microservicios/almacen`).',
                'example'     => "Route::prefix('microservicios/nombre-micro')->group(function () {\n    // Rutas exclusivas del microservicio\n});",
            ],
            [
                'icon'        => 'bi-plugin',
                'label'       => '3. Integración con el Módulo Principal',
                'path'        => 'Servicios',
                'description' => 'El módulo principal no debe consultar directamente la base de datos del microservicio a menos que sea estrictamente necesario. Lo ideal es que interactúen a través de clases de Servicio internas o llamadas HTTP si están muy desacoplados.',
            ],
        ],
    ],
];