<?php

declare(strict_types=1);

return [
    'category'         => 'devops',
    'category_label'   => 'DevOps & Entorno',
    'template'         => 'modules/reference.twig',
    'nav'              => 'Configuración Variables de Entorno',
    'title'            => 'Configuración de Variables de Entorno',
    'tag'              => 'DevOps',
    'summary'          => 'Guía de configuración de variables sensibles y entorno del proyecto.',
    'intro'            => 'La configuración del entorno es crítica para la seguridad del sistema. Nunca subas archivos .env al repositorio; utiliza siempre .env.example como plantilla para tus configuraciones locales y de producción.',
    'features'         => [
        [
            'icon'  => 'bi-shield-lock',
            'title' => 'Seguridad',
            'text'  => 'Los archivos .env contienen credenciales sensibles y deben mantenerse fuera del control de versiones.',
        ],
        [
            'icon'  => 'bi-gear',
            'title' => 'Variables Críticas',
            'text'  => 'Configuración necesaria para Database, Mail y la APP_KEY del sistema.',
        ],
        [
            'icon'  => 'bi-cloud-server',
            'title' => 'Despliegue en Hostinger',
            'text'  => 'Instrucciones específicas para adaptar las variables al entorno de hosting compartido.',
        ],
    ],
    'related_modules' => [
        [
            'label'       => 'Ejecución de Migraciones',
            'slug'        => 'ejecucion-migraciones',
            'description' => 'Una vez configurado el .env, procede a ejecutar las migraciones de base de datos.',
        ],
    ],
    'resources'       => [
        [
            'label' => 'Documentación oficial de Laravel (Variables)',
            'url'   => 'https://laravel.com/docs/configuration',
        ],
    ],
];