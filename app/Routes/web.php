<?php

declare(strict_types=1);

use App\Controllers\PageController;
use Slim\App;

return static function (App $app, PageController $pageController): void {
    $app->get('/', [$pageController, 'home']);

    // Agrupamos dinámicamente todo lo que pertenezca a un directorio de módulos
    $app->group('/{category}', function (\Slim\Routing\RouteCollectorProxy $group) use ($pageController) {
        $group->get('/{slug}', [$pageController, 'module']);
        
        // El beneficio de esto es que en un futuro puedes aplicar Middlewares aquí:
        // })->add(new CategoriaAuthMiddleware());
    });
};
