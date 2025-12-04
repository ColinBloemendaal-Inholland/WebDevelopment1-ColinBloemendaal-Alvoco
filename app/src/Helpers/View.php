<?php 

namespace App\Helpers;

use App\Models\View\View as ViewModel;

class View
{
    public static function View(string $viewPath, ?string $title = null , $data = [])
    {
        // Set default http code
        $http = 200;
        // normalize the view path to match folder structure
        // Explode the view path by dot, lowercase all parts and capitalize them, then implode back with slashes
        $normalizedPath = implode('/', array_map('ucfirst', array_map('strtolower', explode('.', $viewPath))));
        $title = $title ? "{$title} - Alvoco" : "Alvoco";
        if(!file_exists(ROOT . 'src/Views/' . $normalizedPath . '.php')) {
            $http = 404;
            $normalizedPath = 'Errors/404';
        }
        $view = new ViewModel(200,$title, $data);
        require ROOT . 'src/Views/' . $normalizedPath . '.php';
        return $view;
    }
}