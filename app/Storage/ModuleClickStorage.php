<?php

declare(strict_types=1);

namespace App\Storage;

use RuntimeException;

final class ModuleClickStorage
{
    private readonly string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->ensureFileExists();
    }

    public function increment(string $slug): int
    {
        $counts = $this->loadCounts();
        $counts[$slug] = ($counts[$slug] ?? 0) + 1;
        $this->saveCounts($counts);

        return $counts[$slug];
    }

    public function getCount(string $slug): int
    {
        $counts = $this->loadCounts();
        return (int)($counts[$slug] ?? 0);
    }

    public function getAllCounts(): array
    {
        return $this->loadCounts();
    }

    private function ensureFileExists(): void
    {
        $dir = dirname($this->filePath);
        if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
            throw new RuntimeException('No se puede crear el directorio de almacenamiento de vistas.');
        }

        if (!is_file($this->filePath)) {
            file_put_contents($this->filePath, json_encode([], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
        }
    }

    private function loadCounts(): array
    {
        $handle = fopen($this->filePath, 'c+');
        if ($handle === false) {
            throw new RuntimeException('No se puede abrir el archivo de conteo de vistas.');
        }

        if (!flock($handle, LOCK_EX)) {
            fclose($handle);
            throw new RuntimeException('No se puede bloquear el archivo de conteo de vistas.');
        }

        $contents = stream_get_contents($handle);
        if ($contents === false || trim($contents) === '') {
            $counts = [];
        } else {
            $counts = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
            if (!is_array($counts)) {
                $counts = [];
            }
        }

        flock($handle, LOCK_UN);
        fclose($handle);

        return $counts;
    }

    private function saveCounts(array $counts): void
    {
        $handle = fopen($this->filePath, 'c+');
        if ($handle === false) {
            throw new RuntimeException('No se puede abrir el archivo de conteo de vistas para escritura.');
        }

        if (!flock($handle, LOCK_EX)) {
            fclose($handle);
            throw new RuntimeException('No se puede bloquear el archivo de conteo de vistas.');
        }

        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, json_encode($counts, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
        fflush($handle);
        flock($handle, LOCK_UN);
        fclose($handle);
    }
}
