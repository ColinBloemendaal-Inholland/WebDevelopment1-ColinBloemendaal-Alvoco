<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';

$capsule = new Capsule;

// Match your docker-compose mysql config
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'mysql',      
    'database'  => 'Alvoco',
    'username'  => 'developer',
    'password'  => 'secret123',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

// Make DB globally available
$capsule->setAsGlobal();

// Boot Eloquent ORM
$capsule->bootEloquent();