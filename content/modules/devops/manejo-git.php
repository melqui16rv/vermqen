<?php

declare(strict_types=1);

return [
    'category'       => 'devops',
    'category_label' => 'DevOps & Entorno',
    'template'       => 'modules/manual.twig',
    'nav'            => 'Manejo de Git',
    'title'          => 'Manejo de Git en el Proyecto',
    'tag'            => 'DevOps',
    'summary'        => 'Guía práctica del flujo de ramas, PRs y publicación para el equipo de VERMQEN.',
    'intro'          => 'Este módulo documenta la forma de trabajo del equipo con Git y GitHub. Cubre el ciclo completo: desde crear una rama hasta publicar en producción, incluyendo la ruta de emergencia para hotfixes.',
    'pillars'        => [
        [
            'icon'  => 'bi-git',
            'title' => 'Ramas ordenadas',
            'text'  => 'Uso de feature/*, develop, staging, main y hotfix/* con reglas claras de integración.',
        ],
        [
            'icon'  => 'bi-shield-check',
            'title' => 'Revisión antes de merge',
            'text'  => 'Toda integración pasa por Pull Request y aprobación del equipo para reducir errores en producción.',
        ],
        [
            'icon'  => 'bi-lightning-charge',
            'title' => 'Flujo para urgencias',
            'text'  => 'Ruta hotfix para incidentes críticos sin interrumpir el ciclo normal del proyecto.',
        ],
    ],
    'workflow'       => [
        [
            'step'    => '1. Crear rama feature',
            'detail'  => 'Partir desde develop, actualizar cambios y crear una rama con nombre del módulo.',
            'command' => 'git checkout develop && git pull origin develop && git checkout -b feature/modulo-cambio',
        ],
        [
            'step'    => '2. Commits frecuentes',
            'detail'  => 'Guardar avances en checkpoints pequeños con mensajes descriptivos y en español.',
            'command' => 'git add . && git commit -m "feat: describe claramente el cambio"',
        ],
        [
            'step'    => '3. Pull Request a develop',
            'detail'  => 'Subir la rama y abrir PR con contexto funcional y técnico para revisión del equipo.',
            'command' => 'git push origin feature/modulo-cambio',
        ],
        [
            'step'    => '4. Release controlado',
            'detail'  => 'Promover de develop a staging y luego a main tras validación del equipo.',
            'command' => 'PR: develop → staging → main',
        ],
    ],
    'checklist'      => [
        'La rama está sincronizada con develop.',
        'Se eliminaron cambios temporales o de debug.',
        'El PR explica qué cambia y por qué.',
        'Se adjuntó evidencia visual cuando aplica.',
        'El módulo no rompe navegación ni estilos responsive.',
    ],
    'resources'      => [
        [
            'label' => 'GitHub Docs · Pull Requests',
            'url'   => 'https://docs.github.com/en/pull-requests',
        ],
        [
            'label' => 'Atlassian · Branching Workflow',
            'url'   => 'https://www.atlassian.com/git/tutorials/comparing-workflows',
        ],
    ],
    'contribution'   => [
        'title'       => 'Aporte documental inicial (legacy)',
        'description' => 'Documento original del equipo sobre el flujo GitHub. Se integra como fuente documental dentro de la wiki.',
        'source'      => '/flujo-github-vermqen.html',
    ],
];
