<?php 

namespace App\controllers;

use App\https\HttpRequest;
use App\models\Comment;
use App\models\User;
use Controller;

class CommentController extends Controller
{
    private $request;

    public function __construct(HttpRequest $request){
        $this->request = $request;
    }

    public function create()
    {
        if(!empty($this->request->all())){

            $id = $this->request->name('post_id');

            $errors = $this->request->validator([
                'title-comment' => ['required'],
                'comment' => ['required']
            ]);
            $user = User::find('id');
            if(empty($errors)){
    
                $comment = Comment::create([
                    'title' => $this->request->name('title-comment'),
                    'content' => $this->request->name('comment'),
                    'status' => 0,
                    'user_id' => $this->request->name('user_id'),
                    'post_id' => $this->request->name('post_id'),
                ]);
                return redirect('post.show', ['id' => $id], compact('comment'));   
            }else{
                return $this->view('post/show/'.$id, ['errors' => $errors, 'id' => $id]);
            }
             
        }else{
            echo 'pb !!!';
        }
    }
}