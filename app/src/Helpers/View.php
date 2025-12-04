<?php 

namespace App\Helpers;

use App\Models\View\View as ViewModel;

class View
{
    public static function View(string $viewPath, ?string $title = null , $data = [])
    {
        $http = 200;
        $title = $title ? "{$title} - Alvoco" : "Alvoco";
        if(!file_exists(ROOT . 'src/Views/' . $viewPath . '.php')) {
            $http = 404;
            $viewPath = 'Errors/404';
        }
        $view = new ViewModel(200,$title, $data);
        require ROOT . 'src/Views/' . $viewPath . '.php';
        return $view;
    }
}