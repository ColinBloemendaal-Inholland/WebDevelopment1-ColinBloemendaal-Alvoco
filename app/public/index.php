<?php
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use App\Helpers\View;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;

require __DIR__ . '/../vendor/autoload.php';
define('ROOT', value: dirname(__DIR__) . '/'); // points to /app

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    
    $r->addRoute('GET','/leden', ['App\Controllers\LedenController','index']);

    $r->addRoute('GET','/admin/leden', ['App\Controllers\AdminController','index']);
    $r->addRoute('GET','/admin/leden/', ['App\Controllers\AdminController','index']);

    $r->addRoute('GET','/api/leden', ['App\Controllers\LedenController','GetLeden']);

    $r->addRoute('GET','/login', ['App\Controllers\LedenController','loginView']);
    $r->addRoute('POST','/login', ['App\Controllers\LedenController','login']);
});


$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'mysql',
    'database'  => Config::DB_NAME,
    'username'  => Config::DB_SERVER_USER,
    'password'  => Config::DB_PASSWORD,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();



$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        View::View("errors.404");
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