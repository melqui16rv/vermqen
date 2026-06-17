<?php

declare(strict_types=1);

use App\Controllers\PageController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app, PageController $pageController): void {
    $app->get('/', [$pageController, 'home']);

    $app->get('/importaciones', function (ServerRequestInterface $request, ResponseInterface $response) use ($pageController) {
        return $pageController->module($request, $response, [
            'category' => 'sistema',
            'slug'     => 'importaciones',
        ]);
    });

    $app->group('/{category}', function (RouteCollectorProxy $group) use ($pageController) {
        $group->get('/{slug}', [$pageController, 'module']);
    });
};