<?php 
namespace App\controllers;
use Controller;
use App\models\User;
use App\https\HttpRequest;


class UserController extends Controller {

    public function backend(){
        return $this->view('admin/backend');
    }

    public function login(HttpRequest $request){ // bouger la redirection 
        
        if(!empty($request->all())){

            $errors = $request->validator([
                'firstname' => ['required', 'max:12'],
                'pass' => ['required', 'min:5']
            ]);
    
            if(!empty($errors)){
                return $this->view('admin/backend',['errors' => $errors]);
            }else{
                //creation session et redirection espace admin 
                $user = User::where('firstname', '=', $request->name('firstname'))->first();
                if($user !== null){
                    if($request->name('pass') === $user->pass){
                        $request->session('auth', (int) $user->role);
                        $request->session('firstname', $user->firstname);
                        redirect('home.index');
                    }else {
                        echo "mauvais mot de passe";
                    }
                    
                }
            }

        }
        return $this->view('admin.backend');
       
    }

    public function logout(){
        session_destroy();
        redirect('home.index');
    }
}