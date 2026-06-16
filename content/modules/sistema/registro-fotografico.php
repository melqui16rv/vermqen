<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Registro Fotográfico',
    'title'          => 'Registro Fotográfico Ciudad Verde',
    'tag'            => 'Módulo',
    'summary'        => 'Gestión del registro fotográfico de items de dotación, capturando fotos desde cámara o archivo con marcas de agua automáticas e integración con Almacén.',
    'intro'          => 'Módulo diseñado para gestionar el registro fotográfico de los items de dotación de Ciudad Verde. Permite capturar fotos directamente desde la cámara del dispositivo o subir archivos estáticos. Optimiza las imágenes a formato 1:1, controlando el tamaño e inyectando marcas de agua de seguridad de forma dinámica.',
    'features'       => [
        [
            'icon'  => 'bi-camera',
            'title' => 'Captura y Subida (1:1)',
            'text'  => 'Acceso en vivo a la cámara del dispositivo o subida de archivos (JPG, PNG, WebP) con vista previa y recorte automatizado a formato cuadrado (máx 1200x1200px).',
        ],
        [
            'icon'  => 'bi-droplet-half',
            'title' => 'Marcas de Agua Automáticas',
            'text'  => 'Inyección de metadatos visuales sobre la imagen guardada: Fecha y hora en la esquina inferior derecha, y una marca "CFPI" en la esquina izquierda.',
        ],
        [
            'icon'  => 'bi-file-earmark-zip',
            'title' => 'Exportación Consolidada',
            'text'  => 'Soporte para descargas individuales, descarga masiva de todas las fotografías, o generación de un archivo ZIP selectivo desde la galería.',
        ],
        [
            'icon'  => 'bi-shield-check',
            'title' => 'Validación de Duplicados',
            'text'  => 'Control estricto que asegura que un ítem solo tenga UNA foto vinculada, renombrando los archivos bajo el patrón estandarizado: XXX-NOMBRE_ITEM.jpg.',
        ]
    ],
    'architecture_docs' => [
        [
            'title'       => 'Arquitectura Técnica y Procesamiento',
            'description' => 'El módulo se integra perfectamente a la arquitectura MVC aislando sus Controladores y Modelos en `app/Http/Controllers/CiudadVerde/` y `app/Models/CiudadVerde/`. Para la manipulación de imágenes hace uso intensivo de la librería **Intervention Image v3** a través del driver nativo GD. El sistema detecta y carga fuentes TrueType del sistema operativo (`.ttf` / `.ttc`) para generar las marcas de agua de manera fiable.',
        ],
        [
            'title'       => 'Integración Crítica con el Microservicio de Almacén',
            'description' => 'La existencia de este registro fotográfico es **vital para el flujo operativo del Microservicio de Almacén**. Cuando un operario se encuentra clasificando inventario y escanea una placa para asignarla a un ambiente físico, la interfaz gráfica del Almacén consulta mediante API (o relaciones Eloquent) la fotografía procesada por este módulo. Esta confirmación visual le asegura al usuario que el elemento escaneado (ej: Silla Corporativa) corresponde exactamente a la realidad antes de confirmar su ubicación.',
        ],
        [
            'title'       => 'Almacenamiento y Base de Datos',
            'description' => 'Las imágenes procesadas se guardan en el disco público de Laravel (`storage/app/public/ciudad_verde/registro_fotografico/`). A nivel relacional, la tabla restringe la duplicidad mediante una llave única (`UNIQUE`) atada al ID del ítem, conectada con la tabla de fichas técnicas en formato Cascada.',
            'code'        => "CREATE TABLE ciudad_verde_registro_fotografico (\n    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,\n    item INT UNSIGNED NOT NULL UNIQUE,\n    nombre_item VARCHAR(255) NOT NULL,\n    nombre_archivo VARCHAR(255) NOT NULL,\n    ruta_archivo VARCHAR(500) NOT NULL,\n    extension VARCHAR(10) NOT NULL,\n    FOREIGN KEY (item) REFERENCES ciudad_verde_fichas_tecnicas(item) ON DELETE CASCADE\n);"
        ]
    ],
    'developer_docs' => [
        'environment_setup' => [
            'requirements' => [
                'Intervention Image v3', 
                'Extensión PHP GD habilitada', 
                'Fuentes TrueType (.ttf/.ttc)'
            ],
            'commands' => [
                'Instalar Librería'  => 'composer require intervention/image',
                'Link de Almacenamiento' => 'php artisan storage:link'
            ]
        ]
    ],
    'related_modules' => [
        [
            'label'       => 'Módulo Ciudad Verde',
            'slug'        => 'ciudad-verde',
            'description' => 'Módulo general al cual pertenece el subdominio de fichas técnicas y registros fotográficos.',
        ],
        [
            'label'       => 'Microservicio Almacén',
            'slug'        => 'almacen',
            'description' => 'Consume estas fotografías en tiempo real para verificar los ítems durante el escaneo y mapeo de placas.',
        ]
    ]
];
