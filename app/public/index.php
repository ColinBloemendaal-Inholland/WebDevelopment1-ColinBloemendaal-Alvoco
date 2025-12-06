<?php
use App\Helpers\View;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;

define('ROOT', value: dirname(__DIR__) . '/'); // points to /app

require __DIR__ . '/../vendor/autoload.php';

Session::start();

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'mysql',
    'database'  => Config::DB_NAME,
    'username'  => Config::DB_SERVER_USER,
    'password'  => Config::DB_PASSWORD,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

Router::RegisterRoutes();