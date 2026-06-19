<?php

declare(strict_types=1);

use App\Controllers\PageController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\Twig;

return static function (App $app, PageController $pageController): void {
    
    // 1. Ruta de Inicio
    $app->get('/', [$pageController, 'home']);

    // 2. Ruta de Glosario (Corregida: apunta directamente a 'glossary.twig')
    $app->get('/glosario', function (Request $request, Response $response) {
        $view = Twig::fromRequest($request);
        // Cargamos los datos del glosario
        $glossary = require __DIR__ . '/../../content/glossary_data.php';
        return $view->render($response, 'glossary.twig', [
            'pageTitle' => 'Glosario de la Wiki',
            'glossary'  => $glossary
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