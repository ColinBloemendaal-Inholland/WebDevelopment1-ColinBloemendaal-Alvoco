<?php

use App\Controllers\SpelersController;
use FastRoute\RouteCollector;

use App\Controllers\AdminController;
use App\Controllers\LedenController;
use App\Controllers\HomeController;
use App\Controllers\NieuwsberichtenController;
use App\Controllers\TeamsController;
use App\Controllers\WedstrijdenController;
use App\Controllers\TrainersController;
use App\Controllers\CoachesController;
use App\Controllers\BestuursledenController;


return function (RouteCollector $r) {
    // Public routes
    $r->addRoute('GET', '/', [HomeController::class, 'index']);

    // Nieuwsberichten page
    $r->addRoute('GET', '/nieuwsberichten', [NieuwsberichtenController::class, 'index']);
    $r->addRoute('GET', '/nieuwsberichten/{id:\d+}', [NieuwsberichtenController::class, 'show']);

    // Teams page
    $r->addRoute('GET', '/teams', [TeamsController::class, 'index']);
    $r->addRoute('GET', '/teams/{id:\d+}', [TeamsController::class, 'show']);

    // Wedstrijd page
    $r->addRoute('GET', '/wedstrijden', [WedstrijdenController::class, 'index']);
    $r->addRoute('GET', '/wedstrijden/{id:\d+}', [WedstrijdenController::class, 'show']);

    // Contact page
    $r->addRoute('GET', '/contact', [BestuursledenController::class, 'contact']);
    $r->addRoute('POST', '/contact', [BestuursledenController::class, 'storeContact']);

    
    $r->addRoute('POST', '/api/leden', [LedenController::class, 'GetLeden']);
    $r->addRoute('POST', '/api/nieuwsberichten', [NieuwsberichtenController::class, 'GetNieuwsberichten']);
    $r->addRoute('POST', '/api/teams', [TeamsController::class, 'GetTeams']);
    $r->addRoute('POST', '/api/coaches', [CoachesController::class, 'GetCoaches']);
    $r->addRoute('POST', '/api/trainers', [TrainersController::class, 'GetTrainers']);
    $r->addRoute('POST', '/api/wedstrijden', [WedstrijdenController::class, 'GetWedstrijden']);

    $r->addRoute('GET', '/login', [LedenController::class, 'loginView']);
    $r->addRoute('POST', '/login', [LedenController::class, 'login']);

    // Admin routes
    // Admin Dashboard
    $r->addRoute('GET', '/admin', [AdminController::class, 'index']);

    // Admin > Leden
    $r->addRoute('GET', '/admin/leden', [AdminController::class, 'leden']);
    $r->addRoute('GET', '/admin/leden/{id:\d+}', [AdminController::class, 'getLid']);
    $r->addRoute('GET', '/admin/leden/create', [LedenController::class, 'create']);
    $r->addRoute('POST', '/admin/leden/create', [LedenController::class, 'store']);
    $r->addRoute('GET', '/admin/leden/{id:\d+}/edit', [LedenController::class, 'edit']);
    $r->addRoute('PUT', '/admin/leden/{id:\d+}', [LedenController::class, 'update']);
    $r->addRoute('DELETE', '/admin/leden/{id:\d+}', [LedenController::class, 'delete']);
    $r->addRoute('DELETE', '/admin/leden/{id:\d+}/force', [LedenController::class, 'destroy']);

    // Admin > Spelers
    $r->addRoute('GET', '/admin/spelers', [AdminController::class, 'spelers']);
    $r->addRoute('GET', '/admin/spelers/{id:\d+}', [AdminController::class, 'getSpeler']);
    $r->addRoute('GET', '/admin/spelers/create', [SpelersController::class, 'create']);
    $r->addRoute('POST', '/admin/spelers/create', [SpelersController::class, 'store']);
    $r->addRoute('GET', '/admin/spelers/{id:\d+}/edit', [SpelersController::class, 'edit']);
    $r->addRoute('PUT', '/admin/spelers/{id:\d+}', [SpelersController::class, 'update']);
    $r->addRoute('DELETE', '/admin/spelers/{id:\d+}', [SpelersController::class, 'delete']);
    $r->addRoute('DELETE', '/admin/spelers/{id:\d+}/force', [SpelersController::class, 'destroy']);

    // Admin > Nieuwsberichten
    $r->addRoute('GET', '/admin/nieuwsberichten', [AdminController::class, 'nieuwsberichten']);
    $r->addRoute('GET', '/admin/nieuwsberichten/{id:\d+}', [AdminController::class, 'getNieuwsbericht']);
    $r->addRoute('GET', '/admin/nieuwsberichten/create', [NieuwsberichtenController::class, 'create']);
    $r->addRoute('POST', '/admin/nieuwsberichten/create', [NieuwsberichtenController::class, 'store']);
    $r->addRoute('GET', '/admin/nieuwsberichten/{id:\d+}/edit', [NieuwsberichtenController::class, 'edit']);
    $r->addRoute('PUT', '/admin/nieuwsberichten/{id:\d+}', [NieuwsberichtenController::class, 'update']);
    $r->addRoute('DELETE', '/admin/nieuwsberichten/{id:\d+}', [NieuwsberichtenController::class, 'delete']);
    $r->addRoute('DELETE', '/admin/nieuwsberichten/{id:\d+}/force', [NieuwsberichtenController::class, 'destroy']);

    // Admin > Teams
    $r->addRoute('GET', '/admin/teams', [AdminController::class, 'teams']);
    $r->addRoute('GET', '/admin/teams/{id:\d+}', [AdminController::class, 'getTeam']);
    $r->addRoute('GET', '/admin/teams/create', [TeamsController::class, 'create']);
    $r->addRoute('POST', '/admin/teams/create', [TeamsController::class, 'store']);
    $r->addRoute('GET', '/admin/teams/{id:\d+}/edit', [TeamsController::class, 'edit']);
    $r->addRoute('PUT', '/admin/teams/{id:\d+}', [TeamsController::class, 'update']);
    $r->addRoute('DELETE', '/admin/teams/{id:\d+}', [TeamsController::class, 'delete']);
    $r->addRoute('DELETE', '/admin/teams/{id:\d+}/force', [TeamsController::class, 'destroy']);
    // Admin > Coaches
    $r->addRoute('GET', '/admin/coaches', [AdminController::class, 'coaches']);
    $r->addRoute('GET', '/admin/coaches/', [AdminController::class, 'coaches']);
    $r->addRoute('GET', '/admin/coaches/{id:\d+}', [AdminController::class, 'getCoach']);
    $r->addRoute('GET', '/admin/coaches/create', [CoachesController::class, 'create']);
    $r->addRoute('POST', '/admin/coaches/create', [CoachesController::class, 'store']);
    $r->addRoute('GET', '/admin/coaches/{id:\d+}/edit', [CoachesController::class, 'edit']);
    $r->addRoute('PUT', '/admin/coaches/{id:\d+}', [CoachesController::class, 'update']);
    $r->addRoute('DELETE', '/admin/coaches/{id:\d+}', [CoachesController::class, 'delete']);
    $r->addRoute('DELETE', '/admin/coaches/{id:\d+}/force', [CoachesController::class, 'destroy']);

    // Admin > Trainers
    $r->addRoute('GET', '/admin/trainers', [AdminController::class, 'trainers']);
    $r->addRoute('GET', '/admin/trainers/', [AdminController::class, 'trainers']);
    $r->addRoute('GET', '/admin/trainers/{id:\d+}', [AdminController::class, 'getTrainer']);
    $r->addRoute('GET', '/admin/trainers/create', [TrainersController::class, 'create']);
    $r->addRoute('POST', '/admin/trainers/create', [TrainersController::class, 'store']);
    $r->addRoute('GET', '/admin/trainers/{id:\d+}/edit', [TrainersController::class, 'edit']);
    $r->addRoute('PUT', '/admin/trainers/{id:\d+}', [TrainersController::class, 'update']);
    $r->addRoute('DELETE', '/admin/trainers/{id:\d+}', [TrainersController::class, 'delete']);
    $r->addRoute('DELETE', '/admin/trainers/{id:\d+}/force', [TrainersController::class, 'destroy']);

    // Admin > Wedstrijden
    $r->addRoute('GET', '/admin/wedstrijden', [AdminController::class, 'wedstrijden']);
    $r->addRoute('GET', '/admin/wedstrijden/{id:\d+}', [AdminController::class, 'getWedstrijd']);
    $r->addRoute('GET', '/admin/wedstrijden/create', [WedstrijdenController::class, 'create']);
    $r->addRoute('POST', '/admin/wedstrijden/create', [WedstrijdenController::class, 'store']);
    $r->addRoute('GET', '/admin/wedstrijden/{id:\d+}/edit', [WedstrijdenController::class, 'edit']);
    $r->addRoute('PUT', '/admin/wedstrijden/{id:\d+}', [WedstrijdenController::class, 'update']);
    $r->addRoute('DELETE', '/admin/wedstrijden/{id:\d+}', [WedstrijdenController::class, 'delete']);
    $r->addRoute('DELETE', '/admin/wedstrijden/{id:\d+}/force', [WedstrijdenController::class, 'destroy']);

    // Admin > Bestuursleden
    $r->addRoute('GET', '/admin/bestuursleden', [AdminController::class, 'bestuursleden']);
    $r->addRoute('GET', '/admin/bestuursleden/{id:\d+}', [AdminController::class, 'getBestuurslid']);
    $r->addRoute('GET', '/admin/bestuursleden/create', [BestuursledenController::class, 'create']);
    $r->addRoute('POST', '/admin/bestuursleden/create', [BestuursledenController::class, 'store']);
    $r->addRoute('GET', '/admin/bestuursleden/{id:\d+}/edit', [BestuursledenController::class, 'edit']);
    $r->addRoute('PUT', '/admin/bestuursleden/{id:\d+}', [BestuursledenController::class, 'update']);
    $r->addRoute('DELETE', '/admin/bestuursleden/{id:\d+}', [BestuursledenController::class, 'delete']);
    $r->addRoute('DELETE', '/admin/bestuursleden/{id:\d+}/force', [BestuursledenController::class, 'destroy']);
};
