<?php

//ROUTES ARTICLES FRONT
Router::get('/', 'App\controllers\MainController@index')->name('home.index'); // tous les articles
Router::get('/article/([0-9]+)', 'App\controllers\PostController@show')->name('post.show'); // Un article par l'id (\d)

Router::get('/articles', 'App\controllers\PostController@index')->name('post.index'); 
Router::get('/contact', 'App\controllers\MainController@contact')->name('home.contact');

//ROUTES ADMIN 
Router::get('/admin/create', 'App\controllers\back\AdminController@create')->name('admin.create');
Router::post('/admin/create', 'App\controllers\back\AdminController@create')->name('admin.create');
Router::get('/admin/article/([0-9]+)/delete', 'App\controllers\back\AdminController@delete')->name('admin.delete');
Router::get('/admin/edit/([0-9]+)', 'App\controllers\back\AdminController@edit')->name('admin.edit');
Router::post('/admin/edit/([0-9]+)', 'App\controllers\back\AdminController@edit')->name('admin.edit');

Router::get('/admin/article/([0-9]+)', 'App\controllers\back\AdminController@article')->name('admin.article'); // CRUD Articles
Router::get('/admin/comments', 'App\controllers\back\CommentController@index')->name('comments.index'); // CRUD comments
Router::post('/admin/comment/([0-9]+)', 'App\controllers\back\CommentController@validate')->name('comment.validate'); //
Router::get('/admin/comment/([0-9]+)/delete', 'App\controllers\back\CommentController@delete')->name('comment.delete');
Router::get('/admin/articles', 'App\controllers\back\AdminController@index')->name('admin.articles'); // CRUD Articles

//ROUTES USER
Router::get('/user/register', 'App\controllers\UserController@register')->name('user.register'); // pour afficher le form d'enregistrement
Router::post('/user/register', 'App\controllers\UserController@register')->name('user.register'); // pour envoyer la verif puis en bdd

Router::get('/user/login', 'App\controllers\UserController@login')->name('user.login'); // pour afficher le form de connexion
Router::post('/user/login', 'App\controllers\UserController@login')->name('user.login'); // pour envoyer la verif de connexion
Router::get('/user/logout/{id}', 'App\controllers\UserController@logout')->name('user.logout'); 

Router::post('/comment/create', 'App\controllers\CommentController@create')->name('comment.create'); // création commentaire


