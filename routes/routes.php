<?php

Router::get('/', 'App\controllers\PostController@index')->name('post.index');
Router::get('/home/show/([0-9]+)', 'App\controllers\HomeController@show')->name('post.show'); // (\d)

Router::get('/home/delete/([0-9]+)', 'App\controllers\HomeController@delete');
Router::post('/home/create', 'App\controllers\HomeController@create');
Router::post('/createcomment', 'App\controllers\HomeController@createcomment');

Router::get('/user/login', 'App\controllers\UserController@login')->name('user.login'); // pour afficher le form 
Router::post('/user/login', 'App\controllers\AdminController@login')->name('user.login'); // pour envoyer la verif

Router::get('/admin/logout', 'App\controllers\AdminController@logout')->name('admin.logout');