<?php

namespace App\Controllers;

use App\Helpers\View;

class HomeController extends BaseController
{
    public function index($vars = [])
    {

        return View::View('Dashboard.Home', 'Hello home',['user'=> $this->user()]);
    }
}
