<?php

declare(strict_types=1);

use App\Content\ContentRepository;
use App\Controllers\PageController;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/vendor/autoload.php';

if (PHP_SAPI === 'cli-server') {
    $requestPath = (string)parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $staticFile = __DIR__ . $requestPath;
    if (is_file($staticFile) && basename($requestPath) !== 'index.php') {
        return false;
    }
}

if (!isset($_SERVER['ORIGINAL_REQUEST_URI'])) {
    $_SERVER['ORIGINAL_REQUEST_URI'] = $_SERVER['REQUEST_URI'] ?? '/';
}

$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$basePath = rtrim(str_replace('/index.php', '', $scriptPath), '/');

$routeOverride = filter_input(INPUT_GET, 'route', FILTER_UNSAFE_RAW);
if (is_string($routeOverride) && $routeOverride !== '') {
    $normalizedRoute = '/' . ltrim(trim($routeOverride), '/');
    if (preg_match('#^/[a-zA-Z0-9/_-]*$#', $normalizedRoute) === 1) {
        $_SERVER['REQUEST_URI'] = ($basePath === '' ? '' : $basePath) . $normalizedRoute;
    }
}

$app = AppFactory::create();

if ($basePath !== '') {
    $app->setBasePath($basePath);
}

$twig = Twig::create(__DIR__ . '/resources/views', [
    'cache' => false,
]);
$app->add(TwigMiddleware::create($app, $twig));

$contentRepository = new ContentRepository(__DIR__ . '/content');
$pageController = new PageController($twig, $contentRepository);

(require __DIR__ . '/app/Routes/web.php')($app, $pageController);

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->run();
