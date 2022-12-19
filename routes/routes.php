<?php

Router::get('/', 'App\controllers\PostController@index')->name('post.index');
Router::get('/article/([0-9]+)', 'App\controllers\PostController@show')->name('post.show'); // (\d)

Router::get('/post/delete/([0-9]+)', 'App\controllers\HomeController@delete');
Router::post('/post/create', 'App\controllers\PostController@create');

Router::post('/createcomment', 'App\controllers\HomeController@createcomment'); // création commentaire

Router::get('/user/login', 'App\controllers\UserController@login')->name('user.login'); // pour afficher le form 
Router::post('/user/login', 'App\controllers\UserController@login')->name('user.login'); // pour envoyer la verif

Router::get('/user/logout', 'App\controllers\UserController@logout')->name('user.logout');