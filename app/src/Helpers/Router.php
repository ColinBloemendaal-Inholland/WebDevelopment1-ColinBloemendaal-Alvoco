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

            $r->addRoute('POST','/api/leden', ['App\Controllers\LedenController','GetLeden']);
            $r->addRoute('POST','/api/nieuwsberichten', ['App\Controllers\NieuwsberichtenController','GetNieuwsberichten']);

            $r->addRoute('GET','/login', ['App\Controllers\LedenController','loginView']);
            $r->addRoute('POST','/login', ['App\Controllers\LedenController','login']);


            // Admin routing:
            $r->addRoute('GET','/admin/', ['App\Controllers\AdminController','index']);
            $r->addRoute('GET','/admin', ['App\Controllers\AdminController','index']);

            // Admin > Leden routing
            $r->addRoute('GET','/admin/leden/', ['App\Controllers\AdminController','leden']);
            $r->addRoute('GET','/admin/leden', ['App\Controllers\AdminController','leden']);
            $r->addRoute('GET','/admin/leden/create', ['App\Controllers\AdminController','createLeden']);
            $r->addRoute('GET','/admin/leden/create/', ['App\Controllers\AdminController','createLeden']);
            $r->addRoute('POST','/admin/leden/create', ['App\Controllers\AdminController','storeLeden']);
            $r->addRoute('GET','/admin/leden/{id:\d+}/edit', ['App\Controllers\AdminController','editLeden']);

            // Admin > Nieuwsberichten routing
            $r->addRoute('GET','/admin/nieuwsberichten', ['App\Controllers\AdminController','nieuwsberichten']);
            $r->addRoute('GET','/admin/nieuwsberichten/', ['App\Controllers\AdminController','nieuwsberichten']);

            // Admin > Teams routing
            $r->addRoute('GET','/admin/teams', ['App\Controllers\AdminController','teams']);
            $r->addRoute('GET','/admin/teams/', ['App\Controllers\AdminController','teams']);

            // Admin > Coaches
            $r->addRoute('GET','/admin/coaches', ['App\Controllers\AdminController','coaches']);
            $r->addRoute('GET','/admin/coaches/', ['App\Controllers\AdminController','coaches']);

            // Admin > Trainers routing
            $r->addRoute('GET','/admin/trainers', ['App\Controllers\AdminController','trainers']);
            $r->addRoute('GET','/admin/trainers/', ['App\Controllers\AdminController','trainers']);

            // Admin > Wedstrijden routing
            $r->addRoute('GET','/admin/wedstrijden', ['App\Controllers\AdminController','wedstrijden']);
            $r->addRoute('GET','/admin/wedstrijden/', ['App\Controllers\AdminController','wedstrijden']);

            // Admin > Bestuursleden routing
            $r->addRoute('GET','/admin/bestuursleden', ['App\Controllers\AdminController','bestuursleden']);
            $r->addRoute('GET','/admin/bestuursleden/', ['App\Controllers\AdminController','bestuursleden']);            
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