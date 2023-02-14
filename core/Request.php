<?php

use App\https\HttpRequest;

Class Request
{
    private $path;
    private $action;
    private $params = [];
    private $request;
    private $routename;

    public function __construct(string $path, string $action){
        $this->request = new HttpRequest();
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function name(string $name = null){
        $this->routename[$name][] = $this->path;
        return $this->routename;
    }

    public function match($url) 
    {
        $path = preg_replace('#({[/w]+})#','([^/]+)', $this->path); // remplacement ^/ tout sauf les slashs
        
        $pathToMatch = "#^$path$#";
        
        if(preg_match($pathToMatch, $url, $results))
        {
            array_shift($results); //écrase l'url ce qui reste dans le tableau results ce sont les param
            $this->params = $results;
            //var_dump($results);
            return true;
        }else{
            return false;
        }
    }

    public function execute()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $this->getRequest();
        }else{
            $this->postRequest();
        }
    }

    public function getRequest(){
        if(is_string($this->action)){
            $action = explode('@', $this->action);
            $controller = $action[0];
            $controller = new $controller($this->request);
            $method = $action[1];
            return isset($this->params) ? $controller->$method(implode($this->params)) : $controller->$method(); //transforme le tableau en chaine de charactères
        }else{
            call_user_func_array($this->action, $this->params); // permet d'envoyer des fonction dans routes.php
        }
    }
        
    public function postRequest(){
        if(is_string($this->action)){
            $action = explode('@', $this->action);
            $controller = $action[0];
            $controller = new $controller($this->request);
            $method = $action[1];
            return isset($this->params) ? $controller->$method(implode($this->params)) : $controller->$method();
        }else{
            call_user_func_array($this->action, $this->params);
        }
    }
}