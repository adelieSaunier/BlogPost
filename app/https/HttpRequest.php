<?php 
namespace App\https;
//gestion superglobal 

class HttpRequest
{
    protected $posts;
    protected $errors;

    public function __construct(){
        $this->posts = $_POST;
    }
    public function all()
    {
        return $_POST;
    }
    
    public function name(string $field = null){
        if($field == null){
            return $_POST;
        }
        return $_POST[$field];
    }

    public function session($name, $data = null){
        if(!empty($data) | $data != null ){
        $_SESSION[$name] = $data;
        }else{
            return isset($_SESSION[$name]) ? $_SESSION[$name] : "";
        }
    }

    public function validator(array $rules)
    {
    
        foreach($rules as $key=> $valuearray){
            if(array_key_exists($key, $this->posts)){
                foreach($valuearray as $rule){
                    
                    switch($rule){
                        case 'required':
                            $this->required($key, $this->posts[$key]);
                            break;
                        case substr($rule, 0,3) ==='max':
                            $this->max($key, $this->posts[$key], $rule);
                            break;
                        case substr($rule, 0,3) ==='min':
                            $this->min($key, $this->posts[$key], $rule);
                            break;
                        default:
                        break;
                    }
                }
            }
        }
        return $this->getErrors();
        /*if($this->getErrors() != null){
            header('Location: '.$this->lastUrl());
        } else {
            return $this->all(); //retourner les posts $_POST
        }*/
    }

    public function required($name, $value){ //$name = nom du champs et $value = valeur du champs
        $value = trim($value);
        if(!isset($value) || is_null($value) || empty($value)){ // si cette valeur n'est pas soumise ou qu'elle est null ou vide
            $this->errors[$name][] = "$name is required";
        } 
    }

    public function max($name, $value, $rule){ // $rule = règle à verif
        preg_match_all('/(\d+)/', $rule, $matches); // $matches tableau
        $limit =(int) $matches[0][0]; // la valeur renseignée daans mon tableau 
        if(strlen($value) > $limit){
            $this->errors[$name][] = "$name must contain less than or equal to $limit characters";
        }
    }

    public function min($name, $value, $rule){ //
        preg_match_all('/(\d+)/', $rule, $matches); // $matches tableau
        $limit =(int) $matches[0][0]; // la valeur renseignée daans mon tableau 
        if(strlen($value) < $limit){
            $this->errors[$name][] = "$name must contain greater than or equal to $limit characters";
        }
    }

    public function getErrors(){
        /*if(!empty($this->errors)){
            $_SESSION['errors']= $this->errors;
        } else {
            session_destroy();
        }*/
        print '<pre>';
        print_r($this->errors);
        print '</pre>';
        return $this->errors;
        //return isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
    }



}