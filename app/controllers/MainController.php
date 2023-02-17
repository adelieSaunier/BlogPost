<?php 
namespace App\controllers;
use Controller;
use App\https\HttpRequest;

class MainController extends Controller{


    public function index(){
        $this->view('home/index');
    }

    public function contact()
    {
        $this->view('home/contact'); 
    }

}