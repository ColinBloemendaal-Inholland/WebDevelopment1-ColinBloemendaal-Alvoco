<?php


use App\Models\View\View as ViewModel;

class View
{
    public static function view(string $viewPath, string $title, $data = [])
    {
        // Set default http code
        $http = 200;
        $path = self::getNormalizedPath($viewPath);
        if(!file_exists($path)) {
            $http = 404;
            $path = self::getNormalizedPath('Errors.404');
        }

        $title = $title ? "{$title} - Alvoco" : "Alvoco";
        $view = new ViewModel($http, $title,$data)->toArray();
        self::loadView($path, $view);
    }

    private static function loadView(string $path, $data = []) {
        if(!$path) {
            return;
        }
        extract($data);
        // Using include_once to avoid multiple inclusions and so the script doesnt stop executing if file is missing
        include_once self::getNormalizedPath('Layout.Head');
        include_once self::getNormalizedPath('Layout.Nav');
        include_once $path;
        include_once self::getNormalizedPath('Layout.Footer');
    }

    public static function include(string $viewPath) {
        $path = self::getNormalizedPath($viewPath);
        self::loadView($path);
    }

    private static function getNormalizedPath(string $viewPath) {
        // normalize the view path to match folder structure
        // Explode the view path by dot, lowercase all parts and capitalize them, then implode back with slashes
        $normalizedPath = implode('/', array_map('ucfirst', array_map('strtolower', explode('.', $viewPath))));
        return ROOT . 'src/Views/' . $normalizedPath . '.php';
    }

    public static function partial(string $viewPath, $data = []) {
        $path = self::getNormalizedPath($viewPath);
        if(!file_exists($path)) {
            $path = self::getNormalizedPath('Errors.404');
        }

        self::loadPartial($path, $data);
    }

    private static function loadPartial(string $path, $data = []) {
        if(!$path) {
            return;
        }
        extract($data);
        include_once $path;
    }

    public static function redirect(string $uri) {
        header('location:'. $uri);
        exit;
    }
}
