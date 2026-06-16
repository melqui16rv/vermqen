<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Ingreso / Salida',
    'title'          => 'Control Ingreso/Salida - Ciudad Verde',
    'tag'            => 'Gestión Integral',
    'summary'        => 'Registro y monitoreo en tiempo real del flujo de personas y equipos en la sede Ciudad Verde.',
    'intro'          => 'El módulo Control de Ingreso/Salida facilita la supervisión ágil y segura de las entradas y salidas de usuarios (con o sin equipo) en la sede. Ofrece paneles de control en tiempo real (Dashboard) e historiales detallados, asegurando la trazabilidad y la seguridad operativa.',
    'features'       => [
        [
            'icon'  => 'bi-box-arrow-in-right',
            'title' => 'Registro de Accesos',
            'text'  => 'Captura rápida de ingresos y salidas, incluyendo el registro de equipos tecnológicos (marca, serial y observaciones).',
        ],
        [
            'icon'  => 'bi-pie-chart-fill',
            'title' => 'Dashboard en Tiempo Real',
            'text'  => 'Panel principal con métricas en vivo: Total Usuarios, Entradas Hoy, Salidas Hoy y Personas en Sede, junto con gráficos estadísticos por función.',
        ],
        [
            'icon'  => 'bi-funnel-fill',
            'title' => 'Historial y Filtros',
            'text'  => 'Búsqueda avanzada de movimientos mediante filtros por rango de fechas, documento, tipo de registro, función y posesión de equipo.',
        ],
        [
            'icon'  => 'bi-filetype-csv',
            'title' => 'Exportación de Datos',
            'text'  => 'Generación de reportes detallados en formato CSV para análisis, auditorías de seguridad y control administrativo.',
        ],
    ],
    'architecture_docs' => [
        [
            'title'       => 'Interfaz Específica del Módulo (Blade + Tailwind)',
            'description' => 'La UI del módulo Control Ingreso/Salida está construida con componentes de Blade y Tailwind CSS. Destaca el uso de tarjetas informativas con indicadores numéricos codificados por color semántico: Verde para ingresos, Rojo para salidas y Azul para usuarios en sede actualmente, mejorando la lectura rápida de métricas operativas.',
        ],
        [
            'title'       => 'Lógica de Filtros y Exportación',
            'description' => 'El módulo implementa un motor de búsqueda avanzado con múltiples filtros combinados (fecha, documento, función, posesión de equipo). La lógica backend procesa estas consultas complejas y permite la generación dinámica de reportes en formato CSV para facilitar las auditorías de seguridad en la sede.',
        ]
    ],
    'resources'      => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv/vermqen-laravel',
        ],
    ],
];
