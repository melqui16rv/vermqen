<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Content\ContentRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

final class PageController
{
    /**
     * Labels de categorías en el mismo orden que content/wiki-modules.php.
     *
     * @var array<string, string>
     */
    private const CATEGORY_LABELS = [
        'devops'         => 'DevOps & Entorno',
        'sistema'        => 'Módulos del Sistema',
        'microservicios' => 'Microservicios',
    ];

    public function __construct(
        private readonly Twig $twig,
        private readonly ContentRepository $contentRepository,
    ) {
    }

    public function home(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $basePath  = $this->detectBasePath($request);
        $queryMode = $this->useQueryRouting($request);

        $modules    = [];
        $categories = [];

        foreach ($this->contentRepository->allModules() as $slug => $module) {
            $catKey = (string)($module['category'] ?? 'general');
            
            $moduleData = [
                'slug'    => $slug,
                'title'   => $module['title'] ?? $slug,
                'summary' => $module['summary'] ?? '',
                'tag'     => $module['tag'] ?? 'Documentación',
                'path'    => $this->routePath($basePath, '/' . $catKey . '/' . $slug, $queryMode),
            ];

            $modules[] = $moduleData;

            $catKey = (string)($module['category'] ?? 'general');
            if (!isset($categories[$catKey])) {
                $categories[$catKey] = [
                    'key'     => $catKey,
                    'label'   => $this->categoryLabel($catKey),
                    'path'    => $this->routePath($basePath, '/' . $catKey, $queryMode),
                    'modules' => [],
                ];
            }
            $categories[$catKey]['modules'][] = $moduleData;
        }

        return $this->twig->render($response, 'pages/home.twig', [
            'pageTitle'         => 'Wiki del proyecto',
            'currentSlug'       => null,
            'navigation'        => array_slice($this->buildNavigation($basePath, null, $queryMode), 0, 1),
            'modules'           => $modules,
            'categories'        => array_values($categories),
            'legacyPath'        => $this->withBasePath($basePath, '/flujo-github-vermqen.html'),
            'queryRouteExample' => $this->routePath($basePath, '/flujo-github', true),
            'homePath'          => $this->routePath($basePath, '/', $queryMode),
            'assetBase'         => $this->assetBase($basePath),
        ]);
    }

    /**
     * @param array<string, string> $args
     */
    public function module(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $category  = strtolower((string)($args['category'] ?? ''));
        $slug      = strtolower((string)($args['slug'] ?? ''));
        $basePath  = $this->detectBasePath($request);
        $queryMode = $this->useQueryRouting($request);
        $module    = $this->contentRepository->findModule($slug);

        if ($module === null || (string)($module['category'] ?? 'general') !== $category) {
            return $this->twig->render($response->withStatus(404), 'pages/not-found.twig', [
                'pageTitle'    => 'Página no encontrada',
                'navigation'   => $this->buildNavigation($basePath, null, $queryMode),
                'requestedSlug' => $slug,
                'homePath'     => $this->routePath($basePath, '/', $queryMode),
                'assetBase'    => $this->assetBase($basePath),
            ]);
        }

        $module['resources']         = $this->normalizeResourceUrls($module['resources'] ?? [], $basePath, $queryMode);
        $module['related_modules']    = $this->normalizeRelatedModules($module['related_modules'] ?? [], $basePath, $queryMode);
        $module['contribution']       = $this->normalizeContribution($module['contribution'] ?? null, $basePath);

        // Fase 3: cada módulo elige su propio template. Fallback al clásico.
        $template = (string)($module['template'] ?? 'pages/module.twig');

        return $this->twig->render($response, $template, [
            'pageTitle'   => $module['title'] ?? 'Módulo',
            'currentSlug' => $slug,
            'navigation'  => $this->buildNavigation($basePath, $slug, $queryMode),
            'module'      => $module,
            'homePath'    => $this->routePath($basePath, '/', $queryMode),
            'legacyPath'  => $this->withBasePath($basePath, '/flujo-github-vermqen.html'),
            'assetBase'   => $this->assetBase($basePath),
        ]);
    }

    /**
     * Mostrar todos los módulos de una categoría
     *
     * @param array<string, string> $args
     */
    public function category(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $categoryKey = strtolower((string)($args['category'] ?? ''));
        $basePath    = $this->detectBasePath($request);
        $queryMode   = $this->useQueryRouting($request);

        $categoryModules = [];
        $categories = [];
        
        foreach ($this->contentRepository->allModules() as $slug => $module) {
            $catKey = (string)($module['category'] ?? 'general');
            
            $moduleData = [
                'slug'    => $slug,
                'title'   => $module['title'] ?? $slug,
                'summary' => $module['summary'] ?? '',
                'tag'     => $module['tag'] ?? 'Documentación',
                'path'    => $this->routePath($basePath, '/' . $catKey . '/' . $slug, $queryMode),
            ];
            
            if ($catKey === $categoryKey) {
                $categoryModules[] = $moduleData;
            }
            
            if (!isset($categories[$catKey])) {
                $categories[$catKey] = [
                    'key'     => $catKey,
                    'label'   => $this->categoryLabel($catKey),
                    'path'    => $this->routePath($basePath, '/' . $catKey, $queryMode),
                    'modules' => [],
                ];
            }
            $categories[$catKey]['modules'][] = $moduleData;
        }

        if ($categoryModules === []) {
            return $this->twig->render($response->withStatus(404), 'pages/not-found.twig', [
                'pageTitle'    => 'Página no encontrada',
                'navigation'   => $this->buildNavigation($basePath, null, $queryMode),
                'requestedSlug' => $categoryKey,
                'homePath'     => $this->routePath($basePath, '/', $queryMode),
                'assetBase'    => $this->assetBase($basePath),
            ]);
        }

        return $this->twig->render($response, 'pages/category.twig', [
            'pageTitle'    => $this->categoryLabel($categoryKey),
            'currentSlug'  => null,
            'navigation'   => $this->buildNavigation($basePath, null, $queryMode),
            'categoryKey'  => $categoryKey,
            'categoryLabel' => $this->categoryLabel($categoryKey),
            'modules'      => $categoryModules,
            'categories'   => array_values($categories),
            'homePath'     => $this->routePath($basePath, '/', $queryMode),
            'assetBase'    => $this->assetBase($basePath),
        ]);
    }

    // ─── Navigation ──────────────────────────────────────────────────────────

    /**
     * Fase 2: navegación agrupada por categoría con dropdowns.
     *
     * Cada ítem puede ser de tipo 'link' (enlace simple) o 'dropdown'
     * (grupo colapsable con sub-ítems). base.twig renderiza ambos.
     *
     * @return array<int, array<string, mixed>>
     */
    private function buildNavigation(string $basePath, ?string $currentSlug, bool $queryMode): array
    {
        $navigation = [
            [
                'type'   => 'link',
                'label'  => 'Inicio',
                'path'   => $this->routePath($basePath, '/', $queryMode),
                'active' => $currentSlug === null,
            ],
        ];

        // Agrupar módulos por categoría (el orden viene del cargador glob).
        $grouped = [];
        foreach ($this->contentRepository->allModules() as $slug => $module) {
            $catKey = (string)($module['category'] ?? 'general');
            if (!isset($grouped[$catKey])) {
                $grouped[$catKey] = [];
            }
            $grouped[$catKey][] = [
                'label'  => (string)($module['nav'] ?? $module['title'] ?? $slug),
                'path'   => $this->routePath($basePath, '/' . $catKey . '/' . $slug, $queryMode),
                'active' => $currentSlug === $slug,
            ];
        }

        foreach ($grouped as $catKey => $items) {
            $isActive = (bool)array_reduce(
                $items,
                static fn (bool $carry, array $item): bool => $carry || $item['active'],
                false,
            );

            $navigation[] = [
                'type'   => 'dropdown',
                'label'  => $this->categoryLabel($catKey),
                'active' => $isActive,
                'items'  => $items,
            ];
        }

        return $navigation;
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function categoryLabel(string $catKey): string
    {
        return self::CATEGORY_LABELS[$catKey] ?? ucfirst($catKey);
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
    private function normalizeResourceUrls(array $resources, string $basePath, bool $queryMode): array
    {
        foreach ($resources as $index => $resource) {
            $url = trim((string)($resource['url'] ?? ''));
            if ($url === '') {
                unset($resources[$index]);
                continue;
            }

            if (!str_starts_with($url, '/')) {
                continue;
            }

            $route = ltrim($url, '/');
            $parts = array_values(array_filter(explode('/', $route), static fn (string $segment): bool => $segment !== ''));
            if ($parts === []) {
                unset($resources[$index]);
                continue;
            }

            $normalizedParts = array_map([$this, 'normalizeSlug'], $parts);
            if (count($normalizedParts) > 1) {
                $resources[$index]['url'] = $this->withBasePath($basePath, '/' . implode('/', $normalizedParts));
                continue;
            }

            $slug = $normalizedParts[0];
            $module = $this->contentRepository->findModule($slug);
            if ($module !== null) {
                $category = (string)($module['category'] ?? 'general');
                $resources[$index]['url'] = $this->routePath($basePath, '/' . $category . '/' . $slug, $queryMode);
                continue;
            }

            $resources[$index]['url'] = $this->withBasePath($basePath, '/' . $slug);
        }

        return array_values($resources);
    }

    /**
     * @param array<int, array<string, mixed>> $relatedModules
     * @return array<int, array<string, mixed>>
     */
    private function normalizeRelatedModules(array $relatedModules, string $basePath, bool $queryMode): array
    {
        foreach ($relatedModules as $index => $relatedModule) {
            $slug = strtolower(trim((string)($relatedModule['slug'] ?? '')));
            if ($slug === '') {
                unset($relatedModules[$index]);
                continue;
            }

            $slug = $this->normalizeSlug($slug);
            $module = $this->contentRepository->findModule($slug);
            if ($module !== null) {
                $category = (string)($module['category'] ?? 'general');
                $relatedModule['url'] = $this->routePath($basePath, '/' . $category . '/' . $slug, $queryMode);
            } else {
                $relatedModule['url'] = $this->withBasePath($basePath, '/' . $slug);
            }

            $relatedModules[$index] = $relatedModule;
        }

        return array_values($relatedModules);
    }

    private function normalizeSlug(string $value): string
    {
        $slug = strtolower(trim($value));
        $slug = preg_replace('/[^a-z0-9_-]+/', '-', $slug) ?: $slug;
        $slug = preg_replace('/-{2,}/', '-', $slug) ?: $slug;
        $slug = preg_replace('/_{2,}/', '_', $slug) ?: $slug;
        return trim($slug, '-_');
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
        $scriptName   = str_replace('\\', '/', (string)($serverParams['SCRIPT_NAME'] ?? ''));
        $basePath     = rtrim(str_replace('/index.php', '', $scriptName), '/');
        return $basePath === '/' ? '' : $basePath;
    }

    private function useQueryRouting(ServerRequestInterface $request): bool
    {
        $serverParams      = $request->getServerParams();
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
        $route      = ltrim($path, '/');
        if ($route === '') {
            return $entryPoint;
        }

        return $entryPoint . '?route=' . rawurlencode($route);
    }
}