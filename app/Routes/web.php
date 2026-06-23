<?php
declare(strict_types=1);
use App\Controllers\PageController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\Twig;

return static function (App $app, PageController $pageController, 
    \App\Controllers\ApiController $apiController, array $glossaryData): void {
    
    // 1. API pública para módulos y glosario
    $app->get('/api/modulos', [$apiController, 'listModules']);
    $app->post('/api/modulos/{id}/click', [$apiController, 'trackModuleClick']);
    $app->get('/api/glosario', [$apiController, 'listGlossary']);

    // 2. Ruta de Inicio
    $app->get('/', [$pageController, 'home']);

    // 3. Ruta de Glosario
    $app->get('/glosario', function (Request $request, Response $response) use ($glossaryData) {
        $view    = Twig::fromRequest($request);

        $serverParams = $request->getServerParams();
        $scriptName   = str_replace('\\', '/', (string)($serverParams['SCRIPT_NAME'] ?? ''));
        $basePath     = rtrim(str_replace('/index.php', '', $scriptName), '/');
        $basePath     = $basePath === '/' ? '' : $basePath;

        $originalRequestUri = (string)($serverParams['ORIGINAL_REQUEST_URI'] ?? '');
        $queryMode = str_contains($originalRequestUri, 'index.php?route=');

        $entryPoint = $basePath . '/index.php';
        $routePath  = fn(string $path) => $queryMode
            ? $entryPoint . '?route=' . rawurlencode(ltrim($path, '/'))
            : $basePath . $path;

        return $view->render($response, 'glossary.twig', [
            'pageTitle'    => 'Glosario de la Wiki',
            'glossary'     => $glossaryData,
            'homePath'     => $routePath('/'),
            'glossaryPath' => $routePath('/glosario'),
            'assetBase'    => $basePath,
            'navigation'   => [],
            'currentSlug'  => null,
            'showFooter'   => false,
        ]);
    });

    // 3. Ruta específica para importaciones
    $app->get('/importaciones', function (Request $request, Response $response) use ($pageController) {
        return $pageController->module($request, $response, [
            'category' => 'sistema',
            'slug'     => 'importaciones',
        ]);
    });

    // 4. Ruta para mostrar todos los módulos de una categoría
    $app->get('/{category}', [$pageController, 'category']);

    // 5. Ruta para un módulo específico
    $app->group('/{category}', function (RouteCollectorProxy $group) use ($pageController) {
        $group->get('/{slug}', [$pageController, 'module']);
    });
};