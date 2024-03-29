<?php 

namespace App\controllers;

use App\https\HttpRequest;
use App\models\Comment;
use Controller;

class CommentController extends Controller
{
    private $request;

    public function __construct (HttpRequest $request) {
        $this->request = $request;
    }

    public function create() {
        if (!empty($this->request->all())) {

            $id = $this->request->name('post_id');

            $errors = $this->request->validator([
                'title-comment' => ['required'],
                'comment' => ['required']
            ]);
            
            if (empty($errors)) {
                $comment = Comment::create([
                    'title' => $this->request->name('title-comment'),
                    'content' => $this->request->name('comment'),
                    'status' => 0,
                    'user_id' => $this->request->name('user_id'),
                    'post_id' => $this->request->name('post_id'),
                ]);
                flash('comment-message', 'Merci pour commentaire, il sera validé très prochainement');
                return redirect('post.show', ['id' => $id], compact('comment'));   
            }
            return redirect('post.show', ['id' => $id]);
        }
    }
    
}