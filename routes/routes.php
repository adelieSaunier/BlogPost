<?php
Router::get('/', 'HomeController@index');
Router::get('/home/show/{id}', 'HomeController@index');
Router::post('/home/create', 'HomeController@index');