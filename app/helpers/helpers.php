<?php
use App\https\HttpRequest;

function request($instance = null){ // creation obj request
    if($instance == null){
        $instance = new HttpRequest();
    }
    return $instance;
}

function routename($name, $params = [])
{
    $path = Router::url($name, $params);
    echo $path;
}

function redirect($name, $params = [])
{
    $path = Router::url($name, $params);
    header('Location:' . $path);
    exit;
}

function recordedposts(){ // garder la valeur des champs en session
    return isset($_SESSION['input']) ? $_SESSION['input'] : "";
}

function session($val){
    return isset($_SESSION[$val]) ? $_SESSION[$val] : "";
}

function auth() // retourne un tableau avec tout ce qui a été enregistré en session quand l'utilisateur se connecte
{
    $request = request();
    return array(
        'status' => $request->session('auth'),
        'firstname' => $request->session('firstname'),
    );
}

function flash($name = '', $message = '', $class = 'message-success'){
    // si il y a un nom comme register_success par ex
    if (!empty($name)) {
        // Si il n'y a pas de message et qu'il y a un 
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                //on doit l'unset pour que le message ne reste pas après avoir raffraichi la page
                unset($_SESSION[$name]);
            }
    
            if(!empty($_SESSION[$name. '_class'])){
                // pareil on doit l'unset pour que le message ne reste pas après avoir raffraichi la page
                unset($_SESSION[$name. '_class']);
            }
    
            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
}

function isAdmin()
{
    $request = request();
    
    if ($request->session('auth') == 1 ){
        return true;
    }else{
        redirect('user.login');
    }
}