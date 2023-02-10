<?php 
namespace App\controllers;

use App\https\HttpRequest;
use App\models\Vote;
use Controller;


class LikeController extends Controller{

    private $request;

    public function __construct(HttpRequest $request){
        $this->request = $request;
    }

    public function like(){
        var_dump($_POST);
        
        /*
        $json = json_encode($this->request->all());

        if(!empty($this->request->all())){
            $values = $this->request->all();
            Vote::create($values);
            
        }

        return $json;*/

        var_dump($this->request->all());
        //Vote::where('id', '=', $post_id)->update($values);
        

        echo 'je like';
    }	
}