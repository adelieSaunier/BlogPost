<?php
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager;

Manager::schema()->dropIfExists('users');
Manager::schema()->create('users', function ($table) {
    $table->increments('id');
    $table->string('lastname');
    $table->string('firstname');
    $table->string('email')->unique();
    $table->string('pass');
    $table->integer('role');
    $table->timestamps();
});

Manager::schema()->dropIfExists('posts');
Manager::schema()->create('posts', function ($table) {
    
    $table->increments('id');
    $table->string('title');
    $table->string('content');
    $table->string('extract');
    $table->timestamps();
});

Manager::schema()->dropIfExists('comments');
Manager::schema()->create('comments', function ($table) {
    
    $table->increments('id');
    $table->string('title');
    $table->string('content');
    $table->integer('user_id')->unsigned();
    $table->integer('post_id')->unsigned();

    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
    
});