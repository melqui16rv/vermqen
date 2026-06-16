<?php

declare(strict_types=1);

return [
    'category'        => 'sistema',
    'category_label'  => 'Módulos del Sistema',
    'template'        => 'modules/reference.twig',
    'nav'             => 'Ciudad Verde',
    'title'           => 'Módulo Ciudad Verde',
    'tag'             => 'Sistema',
    'summary'         => 'Centro de mando para la gestión técnica y operativa de la dotación del SENA Ciudad Verde, potenciando el control de inventario mediante fichas técnicas detalladas.',
    'intro'           => 'El Módulo Ciudad Verde es el corazón administrativo del proyecto. Su principal impacto radica en transformar un inventario estático en un sistema dinámico y auditable. Al centralizar las fichas técnicas, las ubicaciones y el registro fotográfico, potencia la gestión del microservicio de Almacén dotándolo de un contexto técnico exhaustivo para cada activo (códigos, requerimientos de instalación y cantidades).',
    'features'        => [
        [
            'icon'  => 'bi-speedometer2',
            'title' => 'Dashboard unificado y Atajos',
            'text'  => 'Panel principal que ofrece un resumen en tiempo real del total de fichas registradas y proporciona accesos rápidos para agilizar la operación diaria.',
        ],
        [
            'icon'  => 'bi-search',
            'title' => 'Búsqueda técnica avanzada',
            'text'  => 'Motor de filtrado para localizar activos instantáneamente por número de ítem, código de producto, nombre del elemento o requerimientos de instalación.',
        ],
        [
            'icon'  => 'bi-journal-richtext',
            'title' => 'Gestión de Fichas Técnicas',
            'text'  => 'Digitalización de las especificaciones de la dotación, enlazando cantidades, valores unitarios y requerimientos técnicos directamente con el inventario físico.',
        ],
        [
            'icon'  => 'bi-camera',
            'title' => 'Evidencia y trazabilidad',
            'text'  => 'Registro fotográfico integrado para auditar visualmente el estado, la recepción y la correcta ubicación de los elementos mapeados en la sede.',
        ],
    ],
    'architecture_docs' => [
        [
            'title'       => 'Patrón MVC (Laravel) y Orquestación',
            'description' => 'El desarrollo del módulo "Ciudad Verde" se fundamenta en la arquitectura MVC proporcionada por Laravel. Los Controladores orquestan la lógica de negocio procesando las peticiones de los formularios de búsqueda (filtrando mediante Query Scopes y métodos like/when). Los Modelos de Eloquent encapsulan las reglas de datos, manejando las relaciones complejas entre Fichas Técnicas, Ubicaciones (pisos/ambientes) y los registros fotográficos.',
            'code'        => "// Ejemplo conceptual del manejo de filtros en el Controlador\npublic function index(Request \$request)\n{\n    \$fichas = FichaTecnica::query()\n        ->when(\$request->item, fn(\$query, \$item) => \$query->where('item', 'like', \"%\$item%\"))\n        ->when(\$request->codigo, fn(\$query, \$codigo) => \$query->where('codigo', 'like', \"%\$codigo%\"))\n        ->paginate(15);\n\n    return view('ciudad-verde.dashboard', compact('fichas'));\n}",
        ],
        [
            'title'       => 'Interfaz Gráfica Responsiva (Blade + CSS)',
            'description' => 'La capa de presentación (frontend) hace un uso intensivo del motor de plantillas Blade. Para lograr la interfaz limpia y reactiva mostrada en el Dashboard, se emplean layouts centralizados, componentes reutilizables y un sistema de grillas/flexbox (probablemente TailwindCSS o Bootstrap) para estructurar paneles estadísticos, campos de búsqueda asíncronos o con submit directo y tablas de resultados adaptables.',
        ],
        [
            'title'       => 'Integración de Registro Fotográfico (Storage & ZIP)',
            'description' => 'El módulo de Registro Fotográfico demuestra una integración avanzada con el File System de Laravel (Storage Facade). Las imágenes cargadas se guardan de forma segura, registrando su ruta y metadatos (tamaño, ítem relacionado) en la BD. Adicionalmente, implementa lógica para la generación dinámica de archivos .ZIP, iterando sobre la colección de archivos de un ítem para comprimirlos y forzar la descarga masiva mediante un stream de respuesta.',
            'code'        => "// Lógica conceptual para descarga masiva\n\$zip = new \\ZipArchive;\n\$zipPath = storage_path('app/temp/evidencias.zip');\n\nif (\$zip->open(\$zipPath, \\ZipArchive::CREATE) === TRUE) {\n    foreach (\$fotos as \$foto) {\n        \$zip->addFile(storage_path('app/public/' . \$foto->ruta), \$foto->nombre_original);\n    }\n    \$zip->close();\n}\n\nreturn response()->download(\$zipPath)->deleteFileAfterSend(true);",
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
            'url'   => 'https://github.com/melqui16rv/vermqen-laravel',
        ],
    ],
];
