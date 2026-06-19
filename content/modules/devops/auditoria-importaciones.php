<?php
declare(strict_types=1);
return [
    'category'         => 'devops',
    'category_label'   => 'DevOps & Entorno',
    'template'         => 'modules/manual.twig',
    'nav'              => 'Auditoría',
    'title'            => 'Auditoría de Importaciones Presupuestales',
    'tag'              => 'DevOps',
    'summary'          => 'Sistema de trazabilidad para importaciones masivas (CDP, CRP, OP), monitoreando integridad, rendimiento y cambios en el esquema de datos.',
    'intro'            => 'La modernización de los servicios de importación requiere un registro centralizado. Este módulo de auditoría permite obtener visibilidad total sobre el impacto de cada carga de datos, permitiendo detectar errores, medir densidades de cambio y asegurar la consistencia del presupuesto.',
    'pillars'          => [
        [
            'icon'  => 'bi-shield-check',
            'title' => 'Trazabilidad precisa',
            'text'  => 'Registro detallado por tipo de tabla (CDP|CRP|OP) y por usuario responsable.',
        ],
        [
            'icon'  => 'bi-clock-history',
            'title' => 'Monitoreo de rendimiento',
            'text'  => 'Cálculo de tiempos de ejecución (duración_ms) para optimización de procesos.',
        ],
        [
            'icon'  => 'bi-exclamation-triangle',
            'title' => 'Detección de integridad',
            'text'  => 'Clasificación de resultados (SUCCESS|PARTIAL|FAILED) con desglose de errores en JSON.',
        ],
        
    ],
    'workflow'         => [
        [
            'step'    => '1. Recepción y Validación',
            'detail'  => 'El controlador valida la estructura inicial del archivo antes de procesar.',
            'command' => 'Validation::validateFile($request)',
        ],
        [
            'step'    => '2. Procesamiento Streaming',
            'detail'  => 'Importación de datos detectando inserciones, cambios y filas tocadas.',
            'command' => 'ImportService::executeStreaming()',
        ],
        [
            'step'    => '3. Generación de Resumen',
            'detail'  => 'Construcción del objeto summary con métricas de inserted, changed y touched.',
            'command' => 'Summary::generate()',
        ],
        [
            'step'    => '4. Persistencia de Auditoría',
            'detail'  => 'Registro en la tabla `registros_actualizaciones` con hash y métricas derivadas.',
            'command' => 'Logger::persist(tipo, resultado, detalles)',
        ],
    ],
    'glossary'         => [
        'title'    => 'Conceptos Clave',
        'terms'    => [
            ['term' => 'CDP (Certificado de Disponibilidad Presupuestal)', 'definition' => 'Documento que garantiza que la entidad cuenta con recursos presupuestales disponibles y libres de afectación para realizar un gasto o iniciar una contratación.'],
            ['term' => 'CRP (Certificado de Registro Presupuestal)', 'definition' => 'Documento que ampara los recursos una vez se firma el contrato o se adquiere la obligación, garantizando que ese dinero ya no podrá destinarse a otro fin.'],
            ['term' => 'OP (Orden de Pago)', 'definition' => 'Documento emitido una vez recibido el bien o servicio a satisfacción, que autoriza a tesorería a girar o pagar al contratista o proveedor.'],
        ],
        'relation' => 'Los tres documentos conforman la cadena presupuestal del gasto público: primero el CDP reserva el presupuesto disponible, luego el CRP compromete esos recursos al formalizarse el contrato, y finalmente la OP autoriza el pago una vez se cumple con la entrega del bien o servicio.'
    ],
    'checklist'        => [
        'Se normalizaron fechas y números para evitar falsos positivos en el conteo de cambios.',
        'Se verificó que el hash SHA-256 se genere correctamente para detección de archivos repetidos.',
        'El almacenamiento de `detalle_errores` está limitado para no saturar la base de datos.',
        'Se incluyeron índices compuestos en la tabla para optimizar consultas de auditoría.',
        'Los umbrales de clasificación SUCCESS/PARTIAL/FAILED están definidos correctamente.',
    ],
    'resources'        => [
        [
            'label' => 'Importaciones y auditorias ',
            'url'   => '/sistema/importaciones',
        ],
        [
            'label' => 'Monitoreo de Cargas Masivas',
            'url'   => '',
        ],
    ], 
];