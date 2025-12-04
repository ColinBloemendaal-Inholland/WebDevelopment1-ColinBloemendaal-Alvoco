<?php

namespace App\Helpers;

class Router {
    private static array $routes = [];

    /** Adds a route to the router */
    public static function add(string $method, string $path, array $action, array $middleware = []): void {
        self::$routes[] = [
            'method' => $method,
            'path' => trim($path, '/'),
            'action' => $action,
            'middleware' => $middleware,
        ];
    }

    public static function dispatch(): void {
        $requestUri    = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {

                //TODO: do something for middleware here
                self::callAction($route['action']);
                return;
            }
        }

        http_response_code(404);
        echo 'Not Found';
        exit;
    }

    /** Call the controller action */
    private static function callAction($action)
    {
        if (is_callable($action)) {
            return $action();
        }

        if (is_array($action)) {
            [$controller, $method] = $action;
            var_dump($controller);
            $controllerInstance = new $controller();
            return $controllerInstance->$method();
        }

        throw new \Exception("Invalid route action");
    }

}