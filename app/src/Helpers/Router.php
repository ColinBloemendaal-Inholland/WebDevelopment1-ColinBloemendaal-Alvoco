<?php


use App\Middleware\RoleMiddleware;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use FastRoute\Dispatcher;

// Use fully qualified names in code for RoleMiddleware and View

class Router {
    public static $dispatcher;
    public static function registerRoutes() {
        $routes = require_once ROOT . 'src/routes/web.php';

        self::$dispatcher = simpleDispatcher(function (RouteCollector $r) use ($routes) {
            $routes($r);
        });

        self::handleRoutes();
    }

    protected static function handleRoutes() {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        if ($httpMethod === 'POST' && isset($_POST['_method'])) {
            $httpMethod = strtoupper($_POST['_method']);
            unset($_POST['_method']);
        }
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $routeInfo = self::$dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                \View::View("errors.404", '404');
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                View::View("errors.405", '405');
                break;
            case Dispatcher::FOUND:
                $controllername = $routeInfo[1][0];
                $method = $routeInfo[1][1];
                $params = $routeInfo[2];

                // Middleware: Protect admin routes
                if (strpos($uri, '/admin') === 0 && !RoleMiddleware::handle('admin')) {
                    http_response_code(403);
                    \View::View("errors.403", '403');
                    return;
                }

                $controller = new $controllername();
                $controller->$method($params);
                break;
            default:
                http_response_code(500);
                View::View("errors.500", '500');
                break;
        }
    }
}
