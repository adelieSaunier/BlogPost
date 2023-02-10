<?php 
namespace App\controllers;
use Controller;
use App\https\HttpRequest;
use App\models\Post;
use App\models\Comment;
use App\models\Vote;

class PostController extends Controller
{
    private $request;

    public function __construct(HttpRequest $request){
        $this->request = $request;
    }


    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        //ajouter une condition pour eviter erreur de session
        if($_SESSION){
            $user_id = $_SESSION['id'];
            var_dump($user_id);
        }
        $this->view('home/posts', compact('posts')); // 
    }

    public function show($id){
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->where('status', '=', 1)->get(); // afficher les commentaires avec le statut 1 = en ligne
        
        if($_SESSION){
            $user_id = $_SESSION['id'];
            $session = $_SESSION;
        }else{
            $user_id = null;
            $session = null;
        }
        $votes = Vote::where('post_id', $id)->where('user_id', '=', $user_id)->get();
        
        return $this->view('home/show', compact('post', 'comments','votes', 'user_id', 'session'));  
    }
    
}