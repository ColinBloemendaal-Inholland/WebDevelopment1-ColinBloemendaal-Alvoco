<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    // Public routes
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    $r->addRoute('GET','/leden', ['App\Controllers\LedenController','index']);

    $r->addRoute('POST','/api/leden', ['App\Controllers\LedenController','GetLeden']);
    $r->addRoute('POST','/api/nieuwsberichten', ['App\Controllers\NieuwsberichtenController','GetNieuwsberichten']);

    $r->addRoute('GET','/login', ['App\Controllers\LedenController','loginView']);
    $r->addRoute('POST','/login', ['App\Controllers\LedenController','login']);

    // Admin routes
    $r->addRoute('GET','/admin', ['App\Controllers\AdminController','index']);
    $r->addRoute('GET','/admin/', ['App\Controllers\AdminController','index']);

    // Admin > Leden
    $r->addRoute('GET','/admin/leden', ['App\Controllers\AdminController','leden']);
    $r->addRoute('GET','/admin/leden/', ['App\Controllers\AdminController','leden']);
    $r->addRoute('GET','/admin/leden/{id:\d+}', ['App\Controllers\AdminController','getLid']);
    $r->addRoute('GET','/admin/leden/create', ['App\Controllers\LedenController','create']);
    $r->addRoute('POST','/admin/leden/create', ['App\Controllers\LedenController','store']);
    $r->addRoute('GET','/admin/leden/{id:\d+}/edit', ['App\Controllers\AdminController','editLeden']);
    $r->addRoute('PUT','/admin/leden/{id:\d+}', ['App\Controllers\AdminController','updateLeden']);

    // Admin > Nieuwsberichten
    $r->addRoute('GET','/admin/nieuwsberichten', ['App\Controllers\AdminController','nieuwsberichten']);
    $r->addRoute('GET','/admin/nieuwsberichten/', ['App\Controllers\AdminController','nieuwsberichten']);

    // Admin > Teams
    $r->addRoute('GET','/admin/teams', ['App\Controllers\AdminController','teams']);
    $r->addRoute('GET','/admin/teams/', ['App\Controllers\AdminController','teams']);

    // Admin > Coaches
    $r->addRoute('GET','/admin/coaches', ['App\Controllers\AdminController','coaches']);
    $r->addRoute('GET','/admin/coaches/', ['App\Controllers\AdminController','coaches']);

    // Admin > Trainers
    $r->addRoute('GET','/admin/trainers', ['App\Controllers\AdminController','trainers']);
    $r->addRoute('GET','/admin/trainers/', ['App\Controllers\AdminController','trainers']);

    // Admin > Wedstrijden
    $r->addRoute('GET','/admin/wedstrijden', ['App\Controllers\AdminController','wedstrijden']);
    $r->addRoute('GET','/admin/wedstrijden/', ['App\Controllers\AdminController','wedstrijden']);

    // Admin > Bestuursleden
    $r->addRoute('GET','/admin/bestuursleden', ['App\Controllers\AdminController','bestuursleden']);
    $r->addRoute('GET','/admin/bestuursleden/', ['App\Controllers\AdminController','bestuursleden']);
};
