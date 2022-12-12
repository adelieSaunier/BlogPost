<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
//var_dump($capsule);
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'blogpost',
    'username' => 'root',
    'password' => 'admin-pass',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();