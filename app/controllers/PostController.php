<?php 
namespace App\controllers;
use Controller;
use App\https\HttpRequest;
use App\models\Post;
use App\models\Comment;
class PostController extends Controller
{
    private $request;

    public function __construct(HttpRequest $request){
        $this->request = $request;
    }
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $this->view('home/index', compact('posts')); // 
    }

    public function show($id){
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->get();
        return $this->view('home/show', compact('post', 'comments'));  
    }

    public function create()
    {
        //$request->
    }

    public function createcomment()
    {
        $id = $this->request->name('post_id');
        $fields = $this->request->name();
        Comment::create($fields);
        return redirect('home/show', ['id' => $id]);
    }

    public function delete($id){
        if(isAdmin()){
            Post::destroy($id);
            return redirect('home.index');
        }else {
            return redirect('home.index');
        }
        
    }
}