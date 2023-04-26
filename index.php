<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$loader = new FilesystemLoader('app/Views');
$twig = new Environment($loader);

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\GifController', 'search']);
    $r->addRoute('GET', '/trending', ['App\Controllers\GifController', 'trending']);
    $r->addRoute('GET', '/random', ['App\Controllers\GifController', 'random']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo $twig->render('404.twig');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        [$controllerName, $method] = $handler;
        $controller = new $controllerName;
        $gifs = $controller->{$method}();

        echo $twig->render('gifs.twig', ['gifs' => $gifs]);
        break;
}