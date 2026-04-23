<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Content\ContentRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

final class PageController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly ContentRepository $contentRepository,
    ) {
    }

    public function home(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $basePath = $this->detectBasePath($request);
        $queryMode = $this->useQueryRouting($request);
        $modules = [];
        foreach ($this->contentRepository->allModules() as $slug => $module) {
            $modules[] = [
                'slug' => $slug,
                'title' => $module['title'] ?? $slug,
                'summary' => $module['summary'] ?? '',
                'tag' => $module['tag'] ?? 'Documentación',
                'path' => $this->routePath($basePath, '/' . $slug, $queryMode),
            ];
        }

        return $this->twig->render($response, 'pages/home.twig', [
            'pageTitle' => 'Wiki del proyecto',
            'currentSlug' => null,
            'navigation' => $this->buildNavigation($basePath, null, $queryMode),
            'modules' => $modules,
            'legacyPath' => $this->withBasePath($basePath, '/flujo-github-vermqen.html'),
            'queryRouteExample' => $this->routePath($basePath, '/flujo-github', true),
            'assetBase' => $this->assetBase($basePath),
        ]);
    }

    /**
     * @param array<string, string> $args
     */
    public function module(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $slug = strtolower((string)($args['slug'] ?? ''));
        $basePath = $this->detectBasePath($request);
        $queryMode = $this->useQueryRouting($request);
        $module = $this->contentRepository->findModule($slug);

        if ($module === null) {
            return $this->twig->render($response->withStatus(404), 'pages/not-found.twig', [
                'pageTitle' => 'Página no encontrada',
                'navigation' => $this->buildNavigation($basePath, null, $queryMode),
                'requestedSlug' => $slug,
                'homePath' => $this->routePath($basePath, '/', $queryMode),
                'assetBase' => $this->assetBase($basePath),
            ]);
        }

        $module['resources'] = $this->normalizeResourceUrls($module['resources'] ?? [], $basePath);
        $module['contribution'] = $this->normalizeContribution($module['contribution'] ?? null, $basePath);

        return $this->twig->render($response, 'pages/module.twig', [
            'pageTitle' => $module['title'] ?? 'Módulo',
            'currentSlug' => $slug,
            'navigation' => $this->buildNavigation($basePath, $slug, $queryMode),
            'module' => $module,
            'homePath' => $this->routePath($basePath, '/', $queryMode),
            'legacyPath' => $this->withBasePath($basePath, '/flujo-github-vermqen.html'),
            'assetBase' => $this->assetBase($basePath),
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function buildNavigation(string $basePath, ?string $currentSlug, bool $queryMode): array
    {
        $navigation = [
            [
                'label' => 'Inicio',
                'path' => $this->routePath($basePath, '/', $queryMode),
                'active' => $currentSlug === null,
            ],
        ];

        foreach ($this->contentRepository->allModules() as $slug => $module) {
            $navigation[] = [
                'label' => $module['nav'] ?? $module['title'] ?? $slug,
                'path' => $this->routePath($basePath, '/' . $slug, $queryMode),
                'active' => $currentSlug === $slug,
            ];
        }

        return $navigation;
    }

    private function withBasePath(string $basePath, string $path): string
    {
        $normalizedBase = rtrim($basePath, '/');
        if ($normalizedBase === '') {
            return $path;
        }

        return $path === '/' ? $normalizedBase . '/' : $normalizedBase . $path;
    }

    private function assetBase(string $basePath): string
    {
        return $basePath === '' ? '' : rtrim($basePath, '/');
    }

    /**
     * @param array<int, array<string, mixed>> $resources
     * @return array<int, array<string, mixed>>
     */
    private function normalizeResourceUrls(array $resources, string $basePath): array
    {
        foreach ($resources as $index => $resource) {
            $url = (string)($resource['url'] ?? '');
            if ($url !== '' && str_starts_with($url, '/')) {
                $resources[$index]['url'] = $this->withBasePath($basePath, $url);
            }
        }

        return $resources;
    }

    /**
     * @param array<string, mixed>|null $contribution
     * @return array<string, mixed>|null
     */
    private function normalizeContribution(?array $contribution, string $basePath): ?array
    {
        if ($contribution === null) {
            return null;
        }

        $source = (string)($contribution['source'] ?? '');
        if ($source !== '' && str_starts_with($source, '/')) {
            $contribution['source'] = $this->withBasePath($basePath, $source);
        }

        return $contribution;
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
        if (!$queryMode) {
            return $this->withBasePath($basePath, $path);
        }

        $entryPoint = $this->withBasePath($basePath, '/index.php');
        $route = ltrim($path, '/');
        if ($route === '') {
            return $entryPoint;
        }

        return $entryPoint . '?route=' . rawurlencode($route);
    }
}
