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
            'Stream:técnica que transfiere información de forma continua en pedazos pequeños.',
            'Chunk : porción pequeña de un bloque de datos que se procesa, transfiere o almacena de forma individual.'
        ]
    ],
    'Procesamiento Streaming' => [
        'term' => 'Procesamiento Streaming',
        'definition' => 'Técnica de procesamiento de datos que permite manejar grandes volúmenes de información en tiempo real, procesando los datos a medida que llegan en lugar de esperar a que se complete la carga.'
    ],
    'objeto summary en el módulo de manejo de git' => [
        'term' => 'Objeto Summary',
        'definition' => 'Estructura de datos que contiene un resumen o descripción breve de un módulo, incluyendo su título, resumen, etiqueta y ruta de acceso.'
    ],
    'dns_resolver' => [
        'term' => 'DNS Resolver',
        'definition' => 'Servidor intermedio que actúa como "agenda de contactos" para traducir nombres de dominio a direcciones IP.'
    ],
    'dns' => [
        'term' => 'DNS (Sistema de Nombres de Dominio)',
        'definition' => 'Sistema que traduce nombres de dominio legibles por humanos a direcciones IP que los navegadores pueden entender.'
    ],
    'ui' => [
        'term' => 'UI (Interfaz de Usuario)',
        'definition' => 'Parte de un software o aplicación que permite a los usuarios interactuar con el sistema.'
    ],
    'ux' => [
        'term' => 'UX (Experiencia de Usuario)',
        'definition' => 'Conjunto de factores y elementos que determinan la percepción y satisfacción del usuario al interactuar con un producto o servicio.'
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
    'name server' => [
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
    ],
    'Patron MVC' => [
        'term' => 'Patrón MVC (Modelo-Vista-Controlador)',
        'definition' => 'Arquitectura de software que separa una aplicación en tres componentes principales: Modelo (gestión de datos), Vista (interfaz de usuario) y Controlador (lógica de negocio y coordinación).'
    ],
    'ZIP' => [
        'term' => 'ZIP',
        'definition' => 'Formato de archivo que utiliza compresión para reducir el tamaño de los archivos y facilitar su almacenamiento o transferencia.'
    ],
    'frontend' => [
        'term' => 'Frontend',
        'definition' => 'Parte de una aplicación o sitio web que interactúa directamente con el usuario; la interfaz visual y de experiencia del usuario.'
    ],
    ' Query Scopes' => [
        'term' => 'Query Scopes',
        'definition' => 'Métodos predefinidos en un modelo de Eloquent que permiten reutilizar condiciones comunes en las consultas a la base de datos.'
    ],
    'Modelos de Eloquent (ORM)' => [
        'term' => 'Modelos de Eloquent (ORM)',
        'definition' => 'Sistema de mapeo objeto-relacional (ORM) integrado en Laravel que facilita la interacción con la base de datos a través de modelos PHP.'
    ],
    'métodos like/when '=> [
        'term' => 'Métodos like/when',
        'definition' => 'Funciones de Eloquent que permiten construir consultas dinámicas y condicionales de manera fluida.'
    ],
    'sistema de grillas/flexbox' => [
        'term' => 'Sistema de grillas/flexbox',
        'definition' => 'Técnicas de diseño CSS para crear layouts flexibles y responsivos en el frontend.'
    ],
    'grillas' => [
        'term' => 'Grillas',
        'definition' => 'Sistema de diseño basado en filas y columnas que facilita la organización y alineación de elementos en una página web.'
    ],
    'flexbox' => [
        'term' => 'Flexbox',
        'definition' => 'Modelo de diseño CSS que permite distribuir espacio entre elementos en una interfaz y alinear contenido de manera eficiente, incluso cuando su tamaño es desconocido o dinámico.'
    ],
'bootstrap' => [
        'term' => 'Bootstrap',
        'definition' => 'Framework de diseño web que proporciona estilos predefinidos y componentes para crear sitios web responsivos y modernos.'
    ],
    'TAILWIND' => [
        'term' => 'Tailwind CSS',
        'definition' => 'Framework de diseño para desarrollo web que se basa en el concepto de clases de utilidad.'
    ],
    'Hash'
        => [
            'term' => 'Hash',
            'definition' => 'Valor alfanumérico generado por una función de hash que representa de manera única un conjunto de datos, utilizado para verificar la integridad o autenticidad de la información.'
        ],
        ' Función de hash ' => [
            'term' => 'Función de Hash',
            'definition' => 'Algoritmo que toma una entrada (o "mensaje") y devuelve un valor fijo de longitud, que parece aleatorio. Es utilizado para asegurar la integridad de los datos.'
        ],
    'hash SHA-256 ' => [
        'term' => 'Hash SHA-256',
        'definition' => 'Algoritmo de hash criptográfico que produce un valor de 256 bits (32 bytes) a partir de una entrada dada, utilizado para verificar la integridad de los datos.'
    ],
    'Umbrales de Clasificación' => [
        'term' => 'Umbrales de Clasificación',
        'definition' => 'Límites establecidos para determinar el nivel de sensibilidad o protección de la información.'
    ],
    'servicio SMTP' => [
        'term' => 'Servicio SMTP',
        'definition' => 'Protocolo estándar para enviar correos electrónicos a través de Internet.'
    ],
    'smtp' => [
        'term' => 'SMTP (Simple Mail Transfer Protocol)',
        'definition' => 'Protocolo de comunicación utilizado para enviar correos electrónicos entre servidores de correo.'
    ],
    'Tinker' => [
        'term' => 'Tinker',
        'definition' => 'Herramienta de línea de comandos de Laravel que permite interactuar con la aplicación y la base de datos de manera interactiva.'
    ],
    'Hostinger' => [
        'term' => 'Hostinger',
        'definition' => 'Proveedor de servicios de alojamiento web que ofrece hosting compartido, VPS y servicios relacionados.'
    ],
    'incidencia' => [
        'term' => 'Incidencia',
        'definition' => 'Evento o situación que interrumpe el funcionamiento normal de un servicio o sistema, o que tiene el potencial de hacerlo.'
    ],
    'campos fillable' => [
        'term' => 'Campos Fillable',
        'definition' => 'Propiedad en los modelos de Eloquent que define qué atributos pueden ser asignados masivamente (mass assignment) para proteger contra asignaciones no deseadas.'
    ],
    'kebab-case' => [
        'term' => 'Kebab Case',
        'definition' => 'Estilo de nomenclatura en el que las palabras están separadas por guiones bajos o guiones, y todas las letras son minúsculas.'
    ],
    'snake_case' => [
        'term' => 'Snake Case',
        'definition' => 'Estilo de nomenclatura en el que las palabras están separadas por guiones bajos y todas las letras son minúsculas.'
    ],
    'camelCase' => [
        'term' => 'Camel Case',
        'definition' => 'Estilo de nomenclatura en el que las palabras están unidas sin espacios, y cada palabra después de la primera comienza con mayúscula.'
    ],
    'mapear' => [
        'term' => 'Mapear',
        'definition' => 'Proceso de establecer una correspondencia entre dos conjuntos de datos o estructuras, como mapear campos de un formulario a columnas de una base de datos.'
    ],

];