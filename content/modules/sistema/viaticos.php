<?php

declare(strict_types=1);

return [
    'category'         => 'sistema',
    'category_label'   => 'Módulos del Sistema',
    'template'         => 'modules/manual.twig',
    'nav'              => 'Viáticos',
    'title'            => 'Módulo de Presupuesto de Viáticos',
    'tag'              => 'Financiero',
    'summary'          => 'Gestión especializada de viáticos con filtros automáticos, seguimiento jerárquico (CDP-CRP-OP) y analítica en tiempo real.',
    'intro'            => 'El módulo de Viáticos extiende la funcionalidad del presupuesto general, aplicando filtros inteligentes para segregar gastos de desplazamiento. Utiliza una arquitectura orientada a eventos para el rastreo desde el CDP hasta la orden de pago final.',
    'pillars'          => [
        [
            'icon'  => 'bi-funnel-fill',
            'title' => 'Filtrado Automático',
            'text'  => 'Segregación mediante patrones de texto (VIÁTICOS) en objetos de gasto.',
        ],
        [
            'icon'  => 'bi-graph-up-arrow',
            'title' => 'Analítica en tiempo real',
            'text'  => 'Tableros de control con gráficas interactivas mediante Chart.js.',
        ],
        [
            'icon'  => 'bi-diagram-3-fill',
            'title' => 'Trazabilidad total',
            'text'  => 'Navegación completa y jerárquica entre documentos presupuestales (CDP → CRP → OP).',
        ],
    ],
    'workflow'         => [
        [
            'step'    => '1. Consulta inicial',
            'detail'  => 'Acceder al dashboard principal para visualizar el resumen financiero filtrado.',
            'command' => 'viaticos.dashboard',
        ],
        [
            'step'    => '2. Gestión de CDPs',
            'detail'  => 'Listado avanzado con filtros por estado, fuente y reintegros.',
            'command' => 'viaticos.cdp.index',
        ],
        [
            'step'    => '3. Trazabilidad CRP',
            'detail'  => 'Visualizar compromisos vinculados a un CDP de viáticos específico.',
            'command' => 'viaticos.crp.byCdp',
        ],
        [
            'step'    => '4. Ejecución (OP)',
            'detail'  => 'Verificación de pagos realizados contra CRPs de viáticos.',
            'command' => 'viaticos.op.byCrp',
        ],
        [
            'step'    => '5. Exportación',
            'detail'  => 'Descarga de reportes en formato CSV optimizado para Excel.',
            'command' => 'viaticos.cdp.exportar',
        ],
    ],
    'checklist'        => [
        'Asegurar que el filtro LIKE %VIATICOS% sea consistente en todos los modelos.',
        'Verificar que el namespace de los controladores sea \App\Http\Controllers\Presupuesto\planeacion\Viaticos.',
        'Comprobar la carga de Chart.js en la vista del dashboard.',
        'Validar que las rutas jerárquicas contengan los parámetros correctos.',
        'Confirmar que los colores del tema (púrpura) cumplan con la guía de estilo.',
    ],
    'resources'        => [
        [
            'label' => 'Documentación técnica',
            'url'   => '/instrucciones -viaticos',
        ],
        [
            'label' => 'Dashboard de Viáticos',
            'url'   => '/viaticos',
        ],
    ],
];