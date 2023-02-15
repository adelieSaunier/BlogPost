<?php
namespace App\controllers\back;

use Controller;
use App\https\HttpRequest;
use App\models\Comment;

class CommentController extends Controller {
    protected $request;
    
    public function __construct(HttpRequest $request){
        $this->request = $request;
    }

    public function index()
    {
        if(isAdmin()){
            $commentsToValidate = Comment::where('status','=', 0 )->orderBy('id', 'desc')->get();
            $validatedComments = Comment::where('status','=', 1 )->orderBy('id', 'desc')->get();
            
            $this->view('admin/comments', compact('commentsToValidate', 'validatedComments'));
        }else {
            return redirect('home.index');
        }
        
    }

    public function validate($id){
        
        $comment = Comment::find($id);
        
        $title = $comment->title;
        $comment_id = $comment->id;
        $content = $comment->content;
        $user = $comment->user->lastname;
        $post = $comment->post->title;
        $validatedcomment = [
            'comment_id' => $comment_id,
            'title' => $title,
            'content' => $content,
            'user' => $user,
            'post' => $post
        ];
        
        $comment->update(['status' => 1]);
        $response = json_encode($validatedcomment);
        echo $response;
        //die;
    }
    
    public function delete($id){
        Comment::destroy($id);
    }
}