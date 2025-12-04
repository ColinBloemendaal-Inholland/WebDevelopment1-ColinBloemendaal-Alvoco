<?php 

use App\Helpers\Router;
use App\Controllers\HomeController;

Router::add('GET', '/', [App\Controllers\HomeController::class, 'index']);

