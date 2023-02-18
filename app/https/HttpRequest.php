<?php 
namespace App\https;


class HttpRequest
{
    protected $posts;
    protected $errors;
    

    public function __construct()
    {
        $this->posts = $_POST;
    }

    public function all()
    {
        return $this->posts;
    }
    
    public function name(string $field = null)
    {
        if ($field == null) {
            return $this->posts;
        }
        return htmlspecialchars($this->posts[$field]);
    }

    public function session($name, $data = null)
    {
        if (!empty($data) | $data != null ) {
            $_SESSION[$name] = $data;
        } else {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : "";
        }
    }

    public function validator(array $rules)
    {
        foreach ($rules as $key=> $valuearray) {
            if (array_key_exists($key, $this->posts)) {
                foreach ($valuearray as $rule) {
                    
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
                    $this->session('input', $this->posts);
                }
            }
        }
        return $this->getErrors();
    }

    public function required($name, $value)
    {
        //$name = nom du champs et $value = valeur du champs
        $value = trim($value); 
        // si cette valeur n'est pas soumise ou qu'elle est null ou vide
        if (!isset($value) || is_null($value) || empty($value)) { 
            $this->errors[$name][] = "$name est requis";
        } 
    }

    public function max($name, $value, $rule)
    { 
        preg_match_all('/(\d+)/', $rule, $matches); // $rule = règle à verif, $matches tableau
        $limit =(int) $matches[0][0]; // la valeur renseignée daans mon tableau 
        if(strlen($value) > $limit){
            $this->errors[$name][] = "$name doit faire au maximum $limit charactères";
        }
    }

    public function min($name, $value, $rule)
    { 
        preg_match_all('/(\d+)/', $rule, $matches); // $matches tableau
        $limit =(int) $matches[0][0]; // la valeur renseignée daans mon tableau 
        if(strlen($value) < $limit){
            $this->errors[$name][] = "$name doit faire au minimum $limit charactères";
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
    /*
    public function loadfile($name, $file_destination, array $data)
    {
        
        $file_name = $_FILES[$name]['name'];
        $file_extension = strchr($file_name, ".");
        $file_tmp = $_FILES[$name]['tmp_name'];
        $file_destination = $file_destination . $file_name;

        if(in_array($file_extension, $data))
        {
            if(move_uploaded_file($file_tmp, $file_destination))
            {
                return $file_destination;
            }else{
                flash('file_message', 'le fichier image n\'est pas envoyé' ) ;
            }
        }else{
            flash('file_message', 'l\'extension n\'est pas correct' ) ;
        }
    }*/
}