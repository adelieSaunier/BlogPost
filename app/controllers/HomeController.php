<?php 
namespace App\controllers;

use App\https\HttpRequest;

class HomeController
{
    public function index(){
        echo 'je suis la page index';
    }

    public function show($id){
        echo "je suis la page avec paramètre n " . $id ;
    }

    public function create(HttpRequest $request)
    {
        //$request->
    }
}