<?php 
namespace App\controllers;
use Controller;
use App\https\HttpRequest;

class MainController extends Controller{


    
    private $request;


    public function __construct(HttpRequest $request){
        $this->request = $request;
    }

    public function index(){
        $this->view('home/index');
    }

    public function contact()
    {
        
        $this->view('home/contact'); // 
    }

}