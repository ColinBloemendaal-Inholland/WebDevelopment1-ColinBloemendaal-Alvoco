<?php
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
require __DIR__ . '/../vendor/autoload.php';
define('ROOT', value: dirname(__DIR__) . '/'); // points to /app

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    $r->addRoute('GET', '/hello/{name}', ['App\Controllers\HelloController', 'greet']);
});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo 'Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo 'Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $controllername = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $params = $routeInfo[2];

        $controller = new $controllername();
        $controller->$method($params);
}