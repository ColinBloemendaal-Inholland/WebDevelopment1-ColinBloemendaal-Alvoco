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
        $routes = require_once ROOT . 'src/Routes/web.php';

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
                    \View::view("errors.404", '404', httpCode:404);
                    break;

                case Dispatcher::METHOD_NOT_ALLOWED:
                    \View::view("errors.405", '405', httpCode:405);
                    break;

                case Dispatcher::FOUND:
                    $controllername = $routeInfo[1][0];
                    $method = $routeInfo[1][1];
                    $params = $routeInfo[2];

                    // Middleware: admin
                    if (strpos($uri, '/admin') === 0 && !RoleMiddleware::handle(['bestuurslid', 'beheerder'])) {
                        \View::view("errors.403", '403', httpCode:403);
                        return;
                    }

                    // Middleware: dashboard auth
                    if (strpos($uri, '/profile') === 0 && !\Auth::isLoggedIn()) {
                        \View::view("errors.401", '401', httpCode:401);
                        return;
                    }

                    // Middleware: dashboard teams
                    if (strpos($uri, '/profile/teams') === 0 && !RoleMiddleware::handle(['coach'])) {
                        \View::view("errors.401", '401', httpCode:401);
                        return;
                    }

                    $controller = new $controllername();
                    $controller->$method($params);
                    break;
            }

        }
        catch (ModelNotFoundException $e) {
            error_log($e->getMessage());
            \View::view("errors.404", '404', httpCode:404);
        }
        catch (Throwable $e) {
            error_log($e->getMessage());
            \View::view("errors.500", '500', httpCode:500);
        }
    }
}
