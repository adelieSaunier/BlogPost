<?php

use Request;

class Router {

    private static $request; //stockage des routes en get et en post

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
                var_dump($route);
                die();
            }
        }
        header('HTTP/1.0 404 not found');
    }
}