<?php

namespace App\Controllers;


class HomeController extends BaseController
{
    public function index($vars = [])
    {

        \View::View('Dashboard.Home', 'Hello home',['user'=> $this->user()]);
    }
}
