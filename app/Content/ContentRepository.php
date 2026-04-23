<?php

declare(strict_types=1);

namespace App\Content;

use RuntimeException;

final class ContentRepository
{
    /** @var array<string, array<string, mixed>> */
    private array $modules;

    public function __construct(string $contentPath)
    {
        $moduleFile = rtrim($contentPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'wiki-modules.php';
        if (!is_file($moduleFile)) {
            throw new RuntimeException('No se encontró content/wiki-modules.php');
        }

        $modules = require $moduleFile;
        if (!is_array($modules)) {
            throw new RuntimeException('El contenido de wiki-modules.php no es válido.');
        }

        $this->modules = $modules;
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
