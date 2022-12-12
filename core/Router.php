<?php

use Request as Request;

class Router {

    private static $request; //stockage de toutes les routes en get et en post
    const BASEPATH = "/BlogPost-main";

    public static function get(string $path, string $action){
        $routes = new Request($path, $action);
        self::$request['GET'][] = $routes;
        return $routes;
    }

    public static function post(string $path, string $action){
        $routes = new Request($path, $action);
        self::$request['POST'][] = $routes; // self:: variable statique
        return $routes;
    }

    public static function run(){
        foreach(self::$request[$_SERVER['REQUEST_METHOD']] as $route) // route = objet et instance de la classe request
        {
            if($route->match(trim($_GET['url']), '/')) //si la route match enlever / debut et fin
            { 
                $route->execute(); //
                //var_dump($route);
                die();
            }
        }
        header('HTTP/1.0 404 not found');
    }

    
    public static function url($name, $parameters = []) // Fonction pour nommer les routes paar exemple: home.index
    {
        foreach(self::$request as $key => $value){ // la clée est get ou post
            foreach(self::$request[$key] as $routes){ //
                if(array_key_exists($name, $routes->name())){
                    $route = $routes->name();
                    $path = implode($route[$name]);// tableau transformé en chaine de characteres
                    // tester si le tableau des param n'est pas vide
                    if(!empty($parameters)){
                        //var_dump($_SERVER['REQUEST_URI']);
                        foreach($parameters as $key=>$value){
                            $url =  str_replace("([0-9]+)", $value, $path); // remplacement $key par decimal
                            return self::BASEPATH . '/'. $url;
                        }
                    }else{
                        return self::BASEPATH . '/'. $path;
                    }
                }
            }
        }
    }
}