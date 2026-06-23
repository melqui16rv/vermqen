<?php

declare(strict_types=1);

namespace App\Content;

use RuntimeException;

final class ContentRepository
{
    /** @var array<string, array<string, mixed>> */
    private array $modules;

    /** @var array<string, string> */
    private array $moduleFiles = [];

    public function __construct(string $contentPath)
    {
        $moduleFile = rtrim($contentPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'wiki-modules.php';
        if (!is_file($moduleFile)) {
            throw new RuntimeException('No se encontró content/wiki-modules.php');
        }

        $rawModules = require $moduleFile;
        if (!is_array($rawModules)) {
            throw new RuntimeException('El contenido de wiki-modules.php no es válido.');
        }

        $this->modules = [];
        foreach ($rawModules as $slug => $module) {
            $this->modules[$slug] = $module;
            if (isset($module['__source_file']) && is_string($module['__source_file'])) {
                $this->moduleFiles[$slug] = $module['__source_file'];
            }
        }
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function allModules(): array
    {
        return $this->modules;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findModule(string $slug): ?array
    {
        $normalizedSlug = strtolower(trim($slug));
        if ($normalizedSlug === '') {
            return null;
        }

        return $this->modules[$normalizedSlug] ?? null;
    }
}
