<?php

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Fastroute\Dispatcher;

class Router {
    public static $dispatcher;
    public static function RegisterRoutes() {
        self::$dispatcher = simpleDispatcher(function (RouteCollector $r) {
            $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
            
            $r->addRoute('GET','/leden', ['App\Controllers\LedenController','index']);

            $r->addRoute('GET','/admin/leden', ['App\Controllers\AdminController','index']);
            $r->addRoute('GET','/admin/leden/', ['App\Controllers\AdminController','index']);

            $r->addRoute('GET','/api/leden', ['App\Controllers\LedenController','GetLeden']);

            $r->addRoute('GET','/login', ['App\Controllers\LedenController','loginView']);
            $r->addRoute('POST','/login', ['App\Controllers\LedenController','login']);
        });
        self::HandleRoutes();
    }

    protected static function HandleRoutes() {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $routeInfo = self::$dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                View::View("errors.404");
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                echo 'Method Not Allowed';
                break;
            case Dispatcher::FOUND:
                $controllername = $routeInfo[1][0];
                $method = $routeInfo[1][1];
                $params = $routeInfo[2];

                $controller = new $controllername();
                $controller->$method($params);
        }
    }
}