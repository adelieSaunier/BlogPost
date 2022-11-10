<?php

use Router;

//echo 'test auoloader';
Router::get('/', 'App\controllers\HomeController@index');
Router::get('home/show/{id}', 'App\controllers\HomeController@show');
Router::post('/home/create', 'App\controllers\HomeController@create');