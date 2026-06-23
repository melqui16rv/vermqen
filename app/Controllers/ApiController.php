<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Content\ContentRepository;
use App\Storage\ModuleClickStorage;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

final class ApiController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly ContentRepository $contentRepository,
        private readonly ModuleClickStorage $clickStorage,
        private readonly array $glossaryData,
    ) {
    }

    public function listModules(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $queryMode = $this->useQueryRouting($request);
        $basePath = $this->detectBasePath($request);

        $modules = [];
        foreach ($this->contentRepository->allModules() as $slug => $module) {
            $category = (string)($module['category'] ?? 'general');
            $modules[] = [
                '_id' => $slug,
                'titulo' => (string)($module['title'] ?? $slug),
                'descripcion' => (string)($module['summary'] ?? $module['intro'] ?? $module['description'] ?? ''),
                'url' => $this->routePath($basePath, '/' . $category . '/' . $slug, $queryMode),
                'vistas' => max((int)($module['views'] ?? 0), $this->clickStorage->getCount($slug)),
                'fechaCreacion' => $this->extractCreationDate($slug),
            ];
        }

        return $this->writeJson($response, $modules);
    }

    public function trackModuleClick(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = strtolower(trim((string)($args['id'] ?? '')));
        $module = $this->contentRepository->findModule($id);

        if ($module === null) {
            return $this->writeJson($response, ['error' => 'Módulo no encontrado.'], 404);
        }

        $count = $this->clickStorage->increment($id);

        return $this->writeJson($response, ['success' => true, 'vistas' => $count]);
    }

    public function listGlossary(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $queryMode = $this->useQueryRouting($request);
        $basePath = $this->detectBasePath($request);

        $glossary = [];
        foreach ($this->glossaryData as $item) {
            $anchor = (string)($item['anchor'] ?? '');
            if ($anchor === '') {
                continue;
            }
            $glossary[] = [
                '_id' => $anchor,
                'termino' => (string)($item['term'] ?? ''),
                'definicion' => (string)($item['definition'] ?? ''),
                'aliases' => is_array($item['aliases'] ?? null) ? $item['aliases'] : [],
                'sub_terms' => is_array($item['sub_terms'] ?? null) ? $item['sub_terms'] : [],
                'urlDefinicion' => $this->routePath($basePath, '/glosario/' . rawurlencode($anchor), $queryMode),
            ];
        }

        return $this->writeJson($response, $glossary);
    }

    public function glossaryTerm(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $termSlug = trim((string)($args['slug'] ?? ''));
        if ($termSlug === '') {
            return $response->withHeader('Location', '/glosario')->withStatus(302);
        }

        $matchKey = null;
        foreach ($this->glossaryData as $item) {
            if (isset($item['anchor']) && $item['anchor'] === $termSlug) {
                $matchKey = $item['anchor'];
                break;
            }

            if (isset($item['term']) && $this->normalizeGlossarySlug((string)$item['term']) === $termSlug) {
                $matchKey = $item['anchor'] ?? null;
                break;
            }
        }

        if ($matchKey === null) {
            return $response->withHeader('Location', '/glosario')->withStatus(302);
        }

        $redirect = '/glosario#glossary-' . rawurlencode($matchKey);
        return $response->withHeader('Location', $redirect)->withStatus(302);
    }

    private function writeJson(ResponseInterface $response, mixed $data, int $status = 200): ResponseInterface
    {
        $payload = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $response->getBody()->write($payload === false ? '[]' : $payload);
        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus($status);
    }

    private function extractCreationDate(string $slug): string
    {
        $module = $this->contentRepository->findModule($slug);
        if ($module === null) {
            return date(DATE_ATOM);
        }

        $sourceFile = $module['__source_file'] ?? null;
        if (is_string($sourceFile) && is_file($sourceFile)) {
            return date(DATE_ATOM, filemtime($sourceFile));
        }

        return date(DATE_ATOM);
    }

    private function detectBasePath(ServerRequestInterface $request): string
    {
        $serverParams = $request->getServerParams();
        $scriptName = str_replace('\\', '/', (string)($serverParams['SCRIPT_NAME'] ?? ''));
        $basePath = rtrim(str_replace('/index.php', '', $scriptName), '/');
        return $basePath === '/' ? '' : $basePath;
    }

    private function useQueryRouting(ServerRequestInterface $request): bool
    {
        $serverParams = $request->getServerParams();
        $originalRequestUri = (string)($serverParams['ORIGINAL_REQUEST_URI'] ?? '');
        if ($originalRequestUri !== '' && str_contains($originalRequestUri, 'index.php?route=')) {
            return true;
        }

        $originalPath = (string)parse_url($originalRequestUri, PHP_URL_PATH);
        if ($originalPath !== '' && (str_ends_with($originalPath, '/index.php') || $originalPath === '/index.php')) {
            return true;
        }

        $path = $request->getUri()->getPath();
        return str_ends_with($path, '/index.php') || $path === '/index.php';
    }

    private function routePath(string $basePath, string $path, bool $queryMode): string
    {
        $normalizedBase = rtrim($basePath, '/');
        if ($normalizedBase === '') {
            $normalizedBase = '';
        }

        if (!$queryMode) {
            return $normalizedBase . $path;
        }

        $entryPoint = $normalizedBase === '' ? '/index.php' : $normalizedBase . '/index.php';
        $route = ltrim($path, '/');
        return $route === '' ? $entryPoint : $entryPoint . '?route=' . rawurlencode($route);
    }

    private function normalizeGlossarySlug(string $term): string
    {
        $slug = trim(strtolower($term));
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug) ?: $slug;
        return trim($slug, '-');
    }
}
