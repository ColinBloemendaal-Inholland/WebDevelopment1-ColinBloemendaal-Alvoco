<?php

namespace App\Controllers;

use App\Helpers\View;

class HomeController
{
    public function index($vars = [])
    {
        return View::View('Dashboard.Home', );
    }
}
