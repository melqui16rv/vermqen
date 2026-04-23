<?php

declare(strict_types=1);

use App\Controllers\PageController;
use Slim\App;

return static function (App $app, PageController $pageController): void {
    $app->get('/', [$pageController, 'home']);
    $app->get('/{slug}', [$pageController, 'module']);
};
