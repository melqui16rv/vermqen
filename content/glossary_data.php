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
            'Stream' => 'Flujo de datos: técnica que transfiere información de forma continua en pedazos pequeños.',
            'Chunk' => 'Fragmento o pedazo: porción pequeña de un bloque de datos que se procesa, transfiere o almacena de forma individual.'
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
    ],
    'abstraccion' => [
        'term' => 'Abstracción',
        'definition' => 'Concepto que oculta los detalles técnicos subyacentes de dónde y cómo se procesan o guardan los datos.'
    ],
    'bd' => [
        'term' => 'BD (Base de Datos)',
        'definition' => 'Acrónimo de Base de Datos; conjunto organizado de información estructurada.'
    ],
    'name_server' => [
        'term' => 'Name Server',
        'definition' => 'Servidor web configurado específicamente para alojar y gestionar los registros DNS de un nombre de dominio.'
    ],
    'tailwind' => [
        'term' => 'Tailwind CSS',
        'definition' => 'Framework de diseño para desarrollo web que se basa en el concepto de clases de utilidad.'
    ],
    'backend' => [
        'term' => 'Backend',
        'definition' => 'Parte de una aplicación o sitio web que corre detrás de escena en un servidor; el motor o cerebro de la aplicación.'
    ],
    'pivot_model' => [
        'term' => 'Modelo Pivote',
        'definition' => 'Tabla intermedia utilizada para conectar dos tablas principales que tienen una relación de muchos a muchos (Many-to-Many).'
    ],
    'cdp' => [
        'term' => 'CDP (Certificado de Disponibilidad Presupuestal)',
        'definition' => 'Documento que garantiza que la entidad cuenta con recursos presupuestales disponibles y libres de afectación para realizar un gasto o iniciar una contratación.'
    ],
    'crp' => [
        'term' => 'CRP (Certificado de Registro Presupuestal)',
        'definition' => 'Documento que ampara los recursos una vez se firma el contrato o se adquiere la obligación, garantizando que ese dinero ya no podrá destinarse a otro fin.'
    ],
    'op' => [
        'term' => 'OP (Orden de Pago)',
        'definition' => 'Documento emitido una vez recibido el bien o servicio a satisfacción, que autoriza a tesorería a girar o pagar al contratista o proveedor.'
    ],
    'DevOps' => [
        'term' => 'DevOps',
        'definition' => 'Cultura y conjunto de prácticas que unifican el desarrollo de software (Dev) y las operaciones de TI (Ops) para acortar el ciclo de vida del desarrollo y proporcionar entregas continuas con alta calidad.'
    ]
];