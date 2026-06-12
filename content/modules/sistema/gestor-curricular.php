<?php

declare(strict_types=1);

return [
    'category'       => 'sistema',
    'category_label' => 'Módulos del Sistema',
    'template'       => 'modules/reference.twig',
    'nav'            => 'Gestor Curricular',
    'title'          => 'Gestor Curricular',
    'tag'            => 'Sistema',
    'summary'        => 'Módulo para la gestión y administración del currículo académico, programas y sus componentes formativos.',
    'intro'          => 'El Gestor Curricular permite administrar la estructura académica del sistema: programas, competencias, resultados de aprendizaje y su relación con las actividades formativas. Es el núcleo de la planeación educativa del proyecto.',
    'features'       => [
        [
            'icon'  => 'bi-journal-bookmark-fill',
            'title' => 'Gestión de programas',
            'text'  => 'Creación y mantenimiento de programas formativos con sus competencias asociadas.',
        ],
        [
            'icon'  => 'bi-award',
            'title' => 'Resultados de aprendizaje',
            'text'  => 'Definición y seguimiento de los resultados de aprendizaje por competencia y programa.',
        ],
        [
            'icon'  => 'bi-people-fill',
            'title' => 'Asignación de instructores',
            'text'  => 'Vinculación de instructores a programas y fichas de formación.',
        ],
    ],
    'resources'      => [
        [
            'label' => 'Repositorio del proyecto',
            'url'   => 'https://github.com/melqui16rv',
        ],
    ],
];
