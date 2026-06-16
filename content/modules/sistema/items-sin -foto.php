<?php

declare(strict_types=1);

return [
    'category'         => 'sistema',
    'category_label'   => 'Módulos del Sistema',
    'template'         => 'modules/reference.twig',
    'nav'              => 'Items sin Foto',
    'title'            => 'Gestión de Items sin Foto Requerida',
    'tag'              => 'Configuración',
    'summary'          => 'Gestión de excepciones para ítems eliminados del contrato que no requieren soporte fotográfico en el registro.',
    'intro'            => 'Este módulo documenta la lógica de exclusión para ítems de dotación eliminados durante la ejecución. Permite mantener el histórico en el sistema ajustando los indicadores de cumplimiento para reflejar solo ítems activos.',
    
    'features'         => [
        [
            'icon'  => 'bi-calculator',
            'title' => 'Cálculo de Indicadores',
            'text'  => 'El porcentaje de avance se ajusta automáticamente excluyendo los 32 ítems sin foto del total procesable.',
        ],
        [
            'icon'  => 'bi-sliders',
            'title' => 'Configuración Centralizada',
            'text'  => 'Listado maestro en config/ciudad_verde.php que controla la lógica en el servicio de registro fotográfico.',
        ],
        [
            'icon'  => 'bi-info-circle',
            'title' => 'Interfaz Informativa',
            'text'  => 'Notas en formularios de creación que explican al usuario la exclusión de ítems eliminados.',
        ],
    ],

    'related_modules' => [
        [
            'label'       => 'Módulo Ciudad Verde',
            'slug'        => 'ciudad-verde', 
            'description' => 'Módulo central para la gestión de proyectos operativos y control de dotaciones.',
        ],
        [
            'label'       => 'Importaciones',
            'slug'        => 'importaciones', 
            'description' => 'Servicio de carga masiva donde se definen inicialmente los ítems del contrato.',
        ],
    ],
];