<?php 
namespace App\controllers;
use Controller;
use App\models\User;
use App\https\HttpRequest;


class UserController extends Controller {

    private $request;


    public function __construct(HttpRequest $request){
        $this->request = $request;
    }


    public function register(){
        if(!empty($this->request->all())){
            $errors = $this->request->validator([

                'firstname' => ['required','max:12'],
                'lastname' => ['required'],
                'email' => ['required'],
                'pass' => ['required', 'min:5']

            ]);
            
            if(!empty($errors)){

                return $this->view('user/register',['errors' => $errors]);

            }else{

                $user = User::create([
                    'firstname' => $this->request->name('firstname'),
                    'lastname' => $this->request->name('lastname'),
                    'email' => $this->request->name('email'),
                    'pass' => password_hash($this->request->name('pass'), PASSWORD_DEFAULT),
                    'role' => 2,
                ]);
                
                $this->createsession($user);
                return redirect('post.index');
            }
        }else{
            return $this->view('user/register');
        }
        
    }

    
    public function login(){ // bouger la redirection 
        
        if(!empty($this->request->all())){

            $errors = $this->request->validator([
                'firstname' => ['required', 'max:12'],
                'pass' => ['required', 'min:5']
            ]);
    
            if(!empty($errors)){
                return $this->view('user/login',['errors' => $errors]);
            }else{
                //creation session et redirection vers les articles
                $user = User::where('firstname', '=', $this->request->name('firstname'))->first();

                if($user !== null){
                    if(password_verify($this->request->name('pass'),$user->pass)){
                        $this->createsession($user);
                        redirect('post.index');
                    }else {
                        echo "mauvais mot de passe";
                    }
                }
            }
        }
        return $this->view('user/login');
       
    }

    public function createsession($user){
        $this->request->session('auth', $user->role);
        $this->request->session('firstname', $user->firstname);
        $this->request->session('id', $user->id);
    }

    public function logout(){
        session_destroy();
        redirect('post.index');
    }

    public function deleteFavorite(){ 
        // je dois lui passer l'id fu favori
        //je dois sécuriser ma route avec un token 
        //je recup les données en json que je dois décoder
        
        //$data = json_decode($this->request->);
        //on verrif si le token est valide avec le nom delete
        //on verrif le nom de l'article 
        //if(){

            //SUPP en bdd
            
            //on repond en json
            //return new JsonResponse(['success' => 1 ]);
        //}else{
            //return new JsonResponse(['error' => 'Token Invalide'], 400);
        //}

    }
}