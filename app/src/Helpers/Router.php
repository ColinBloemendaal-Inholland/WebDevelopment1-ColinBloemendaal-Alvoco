<?php


use App\Middleware\RoleMiddleware;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use FastRoute\Dispatcher;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Router
{
    public static $dispatcher;
    public static function registerRoutes()
    {
        // Using require_once so it fails if file is missing
        $routes = require_once ROOT . 'src/routes/web.php';

        self::$dispatcher = simpleDispatcher(function (RouteCollector $r) use ($routes) {
            $routes($r);
        });

        self::handleRoutes();
    }

    protected static function handleRoutes()
    {
        try {
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
                    \View::view("errors.404", '404');
                    break;

                case Dispatcher::METHOD_NOT_ALLOWED:
                    http_response_code(405);
                    \View::view("errors.405", '405');
                    break;

                case Dispatcher::FOUND:
                    $controllername = $routeInfo[1][0];
                    $method = $routeInfo[1][1];
                    $params = $routeInfo[2];

                    // Middleware: admin
                    if (strpos($uri, '/admin') === 0 && !RoleMiddleware::handle(['bestuurslid', 'beheerder'])) {
                        http_response_code(403);
                        \View::view("errors.403", '403');
                        return;
                    }

                    // Middleware: dashboard auth
                    if (strpos($uri, '/profile') === 0 && !\Auth::isLoggedIn()) {
                        http_response_code(401);
                        \View::view("errors.401", '401');
                        return;
                    }

                    // Middleware: dashboard teams
                    if (strpos($uri, '/profile/teams') === 0 && !RoleMiddleware::handle(['coach'])) {
                        http_response_code(401);
                        \View::view("errors.401", '401');
                        return;
                    }

                    $controller = new $controllername();
                    $controller->$method($params);
                    break;
            }

        } catch (ModelNotFoundException $e) {
            \View::view("errors.404", '404');
        }
        // catch (Throwable $e) {
        //     \View::view("errors.500", '500');
        // }
    }

}
