<?php
use App\https\HttpRequest;

function request($instance = null){ // creation obj request
    if($instance == null){
        $instance = new HttpRequest();
    }
    return $instance;
}

function routename($name, $params = []){
    $path = Router::url($name, $params);
    echo $path;
}

function redirect($name, $params=[]){
    $path = Router::url($name, $params);
    header('Location:' . $path);
}

function recordedposts(){ // garder les champs 
    return isset($_SESSION['input']) ? $_SESSION['input'] : "";
}

function session($val){
    return isset($_SESSION[$val]) ? $_SESSION[$val] : "";
}

function errors(){
    $request = new HttpRequest;
    $errors = $request->getErrors();
    var_dump($errors);
    $dataerrors = [];
    if(!empty($errors)){
        foreach ($errors as $key => $value){ // fusionner les tableaux
            $dataerrors = array_merge_recursive($dataerrors, array($key => implode($value)));
        }
    }
    return isset($dataerrors) ? $dataerrors : ""; // si il y a des erreurs les retourner sinon retourner vide
}

function auth() // retourne un tableau avec tout ce qui a été enregistré en session quand l'utilisateur se connecte
{
    $request = request();
    return array(
        'status' => $request->session('auth'),
        'firstname' => $request->session('firstname')
    );
}

function isAdmin(){
    $request = request();
    if ($request->session('auth')== 1 ){
        return true;
    }else{
        redirect('admin.backend');
    }
}