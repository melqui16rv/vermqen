<?php

declare(strict_types=1);

/**
 * Cargador automático de módulos.
 *
 * Recorre content/modules/{categoria}/*.php en el orden definido en
 * $categoryOrder y devuelve un array plano keyed por slug, listo para
 * ser consumido por ContentRepository.
 *
 * Para agregar un módulo nuevo basta con crear un archivo PHP en la
 * carpeta de la categoría correspondiente — no es necesario editar
 * este archivo.
 */

// Orden de aparición de categorías en la navegación y en el home.
$categoryOrder = ['devops', 'sistema', 'microservicios'];

$modules = [];

foreach ($categoryOrder as $category) {
    $dir = __DIR__ . \DIRECTORY_SEPARATOR . 'modules' . \DIRECTORY_SEPARATOR . $category;

    if (!is_dir($dir)) {
        continue;
    }

    foreach ((array) glob($dir . \DIRECTORY_SEPARATOR . '*.php') as $file) {
        if (!is_string($file) || !is_file($file)) {
            continue;
        }

        $slug = basename($file, '.php');
        $data = require $file;

        if (!is_array($data)) {
            continue;
        }

        // Asegurar que el campo category siempre esté presente.
        $data['category'] = (string)($data['category'] ?? $category);

        $modules[$slug] = $data;
    }
}

return $modules;
