<?php

declare(strict_types=1);

return [
    'flujo-github' => [
        'nav' => 'Flujo GitHub',
        'title' => 'Flujo de trabajo con GitHub',
        'tag' => 'Módulo inicial',
        'summary' => 'Guía práctica del flujo de ramas, PRs y publicación para el equipo de VERMQEN.',
        'intro' => 'Este módulo documenta la forma de trabajo del equipo. Está estructurado para evolucionar a wiki completa con más submódulos.',
        'pillars' => [
            [
                'icon' => 'bi-git',
                'title' => 'Ramas ordenadas',
                'text' => 'Uso de feature/*, develop, staging, main y hotfix/* con reglas claras de integración.',
            ],
            [
                'icon' => 'bi-shield-check',
                'title' => 'Revisión antes de merge',
                'text' => 'Toda integración pasa por Pull Request y aprobación para reducir errores en producción.',
            ],
            [
                'icon' => 'bi-lightning-charge',
                'title' => 'Flujo para urgencias',
                'text' => 'Ruta hotfix para incidentes críticos sin romper el ciclo normal del proyecto.',
            ],
        ],
        'workflow' => [
            [
                'step' => '1. Crear rama feature',
                'detail' => 'Partir desde develop, actualizar cambios y crear una rama con nombre del módulo.',
                'command' => 'git checkout develop && git pull origin develop && git checkout -b feature/modulo-cambio',
            ],
            [
                'step' => '2. Commits frecuentes',
                'detail' => 'Guardar avances en checkpoints pequeños y con mensajes descriptivos.',
                'command' => 'git add . && git commit -m "Describe claramente el cambio"',
            ],
            [
                'step' => '3. Pull Request a develop',
                'detail' => 'Subir la rama y abrir PR con contexto funcional y técnico para revisión.',
                'command' => 'git push origin feature/modulo-cambio',
            ],
            [
                'step' => '4. Release controlado',
                'detail' => 'Promover de develop a staging y luego a main tras validación del equipo.',
                'command' => 'PR: develop -> staging -> main',
            ],
        ],
        'checklist' => [
            'La rama está sincronizada con develop.',
            'Se eliminaron cambios temporales o debug.',
            'El PR explica qué cambia y por qué.',
            'Se adjuntó evidencia visual cuando aplica.',
            'El módulo no rompe navegación ni estilos responsive.',
        ],
        'resources' => [
            [
                'label' => 'GitHub Docs · Pull Requests',
                'url' => 'https://docs.github.com/en/pull-requests',
            ],
            [
                'label' => 'Atlassian Git branching workflow',
                'url' => 'https://www.atlassian.com/git/tutorials/comparing-workflows',
            ],
        ],
        'contribution' => [
            'title' => 'Aporte documental inicial (legacy)',
            'description' => 'Este documento es el aporte original del equipo sobre el flujo GitHub. Se integra como fuente documental dentro de la wiki.',
            'source' => '/flujo-github-vermqen.html',
        ],
    ],
];
