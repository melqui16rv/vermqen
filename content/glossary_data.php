<?php
declare(strict_types=1);

return [
    'dashboard' => [
        'term' => 'Dashboard',
        'definition' => 'Interfaz visual que reúne, organiza y presenta datos clave y métricas de rendimiento en tiempo real.',
        'aliases' => ['Cuadro de mando', 'Panel de control', 'Tablero de control', 'Panel ejecutivo']
    ],
    'facade' => [
        'term' => 'Storage Facade',
        'definition' => 'Interfaz simple que funciona como una "fachada" para gestionar el almacenamiento de archivos.',
        'sub_terms' => [
            'Facade' => 'Patrón de diseño que ofrece una interfaz simple a un sistema complejo.',
            'Storage' => 'Sistema para guardar, leer y borrar archivos locales o remotos.'
        ]
    ],
    'crud' => [
        'term' => 'CRUD',
        'definition' => 'Acrónimo de Create (Crear), Read (Leer), Update (Actualizar), Delete (Eliminar). Operaciones fundamentales de bases de datos.'
    ],
    'stream_chunk' => [
        'term' => 'Stream & Chunk',
        'definition' => 'Técnicas para procesar información por fragmentos pequeños (chunks) en lugar de cargar todo el archivo en la RAM.',
        'sub_terms' => [
            'Stream' => 'Flujo de datos continuo.',
            'Chunk' => 'Porción pequeña de un bloque de datos.'
        ]
    ],
    'dns_resolver' => [
        'term' => 'DNS Resolver',
        'definition' => 'Servidor intermedio que actúa como "agenda de contactos" para traducir nombres de dominio a direcciones IP.'
    ],
    'ui_ux' => [
        'term' => 'UI / UX',
        'definition' => 'UI (User Interface) se enfoca en la estética y lo visual; UX (User Experience) se enfoca en la lógica, el sentimiento y la usabilidad.',
    ],
    'blade' => [
        'term' => 'Blade',
        'definition' => 'Motor de plantillas simple pero potente integrado en Laravel.'
    ]
];