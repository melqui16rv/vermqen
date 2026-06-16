<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Panel Principal',
    'title'          => 'Sistema Base - AppCide',
    'tag'            => 'Core',
    'summary'        => 'Núcleo centralizado para la autenticación, seguridad 2FA, gestión de perfiles y control de acceso a todos los módulos.',
    'intro'          => 'El Panel Principal (Sistema AppCide) actúa como el corazón del ecosistema. Su función es centralizar de forma unificada la gestión de usuarios, la seguridad (como la Autenticación de 2 Factores) y los permisos de acceso global, orquestando de manera segura qué usuarios pueden entrar a qué módulos específicos (Presupuesto, Ciudad Verde, Gestor Curricular, etc.).',
    'features'       => [
        [
            'icon'  => 'bi-shield-check',
            'title' => 'Seguridad y Autenticación 2FA',
            'text'  => 'Sistema unificado de login con protección avanzada mediante verificación de dos factores para todas las cuentas.',
        ],
        [
            'icon'  => 'bi-person-badge',
            'title' => 'Gestión de Perfil',
            'text'  => 'Administración centralizada de la información personal del usuario, correos verificados y contraseñas.',
        ],
        [
            'icon'  => 'bi-grid-fill',
            'title' => 'Directorio de Aplicaciones',
            'text'  => 'Lanzador dinámico que muestra y da acceso directo a los módulos permitidos según los privilegios del usuario activo.',
        ],
        [
            'icon'  => 'bi-key',
            'title' => 'Control de Permisos Global',
            'text'  => 'Gestión centralizada de roles y asignación de permisos que aplica a través de todos los submódulos del monolito.',
        ],
    ],
    'architecture_docs' => [
        [
            'title'       => 'Arquitectura Monolito Modular (Laravel)',
            'description' => 'El ecosistema "Sistema - AppCide" está diseñado como un **Monolito Modular** en Laravel. Posee un núcleo central unificado (base de datos y autenticación), pero aísla estrictamente el código de dominio de cada módulo (`IngresoSalida`, `GestorCurricular`, `Presupuesto`, `CiudadVerde`) en sus propias carpetas de controladores, modelos y vistas. Esto previene conflictos y facilita su escalabilidad independiente.',
        ],
        [
            'title'       => 'Relación y Centralización de Módulos',
            'description' => 'Ningún submódulo implementa un login propio; todos heredan la sesión del Panel Principal. La gestión de accesos se orquesta globalmente mediante modelos pivote (`UserAppAccess` y `RolApp`), permitiendo controlar desde un solo punto quién puede ingresar a qué aplicación.',
        ]
    ],
    'resources'      => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
