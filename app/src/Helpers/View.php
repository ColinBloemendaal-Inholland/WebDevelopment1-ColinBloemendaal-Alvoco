<?php


use App\Models\View\View as ViewModel;

class View
{
    public static function View(string $viewPath, string $title, $data = [])
    {
        // Set default http code
        $http = 200;
        $path = self::GetNormalizedPath($viewPath);
        if(!file_exists($path)) {
            $http = 404;
            $path = self::GetNormalizedPath('Errors.404');
        }

        $title = $title ? "{$title} - Alvoco" : "Alvoco";
        $view = new ViewModel($http, $title,$data)->toArray();
        self::LoadView($path, $view);
    }

    private static function LoadView(string $path, $data = []) {
        if(!$path) {
            return;
        }
        extract($data);
        // Using include_once to avoid multiple inclusions and so the script doesnt stop executing if file is missing
        include_once self::GetNormalizedPath('Layout.Head');
        include_once self::GetNormalizedPath('Layout.Nav');
        include_once $path;
        include_once self::GetNormalizedPath('Layout.Footer');
    }

    public static function Include(string $viewPath) {
        $path = self::GetNormalizedPath($viewPath);
        self::LoadView($path);
    }

    private static function GetNormalizedPath(string $viewPath) {
        // normalize the view path to match folder structure
        // Explode the view path by dot, lowercase all parts and capitalize them, then implode back with slashes
        $normalizedPath = implode('/', array_map('ucfirst', array_map('strtolower', explode('.', $viewPath))));
        return ROOT . 'src/Views/' . $normalizedPath . '.php';
    }

    public static function Partial(string $viewPath, $data = []) {
        $http = 200;
        $path = self::GetNormalizedPath($viewPath);
        if(!file_exists($path)) {
            $http = 404;
            $path = self::GetNormalizedPath('Errors.404');
        }

        self::LoadPartial($path, $data);
    }

    private static function LoadPartial(string $path, $data = []) {
        if(!$path) {
            return;
        }
        extract($data);
        require_once $path;
    }

    public static function Redirect(string $uri) {
        header('location:'. $uri);
        exit;
    }
}
