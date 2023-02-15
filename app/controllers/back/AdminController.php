<?php 

namespace App\controllers\back;

use Controller;
use App\https\HttpRequest;
use App\models\Post;


class AdminController extends Controller
{

    private $request;

    public function __construct(HttpRequest $request){
        $this->request = $request;
    }

    public function index(){
        $posts = Post::all();
        $this->view('admin/articles', compact('posts'));
    }

    public function create()
    {

        // pour ajout d'une image methode loadfile dans httprequest
        // $image = $this->request->loadfile('imagefile','assets/img/upload', ['.png', '.jpg', '.jpeg'])

        if(isAdmin()){
            if(!empty($this->request->all())){

                $errors = $this->request->validator([
                    'title' => ['required'],
                    'extract' => ['required'],
                    'content' => ['required']
                ]);
                
                if(!empty($errors)){
                    return $this->view('admin/createpost',['errors' => $errors]);
                }else{
                    $values = $this->request->all();
                    Post::create($values);
                    return redirect('post.index');
                }
            }else{
                return $this->view('admin/createpost');
            }
        }else {
            return redirect('post.index'); // retour page d'accueil
        }
    }

    public function edit($id)
    {

        if(!empty($this->request->all())){
            $errors= $this->request->validator([
                'title' => ['required'],
                'extract' => ['required'],
                'content' => ['required']
            ]);

            if(!empty($errors)){
                return $this->view('admin/edit', ['errors' => $errors, 'id' => $id]);
            }else{
                $values = $this->request->all();
                Post::where('id', '=', $id)->update($values);
                redirect('post.show',['id'=> $id]);
            }
        }else{
            $post = Post::find($id);
            return $this->view('admin/article', compact('post'));
        }
    }

    public function delete($id){
        if (isAdmin()) {
            if (Post::find($id)->postComments()) {
                Post::find($id)->postComments()->delete();
            }
            Post::destroy($id);

            flash('user_message', 'Votre article a été supprimé avec succès');
            //return redirect('admin.articles'); // à changer pour l'admin vue
        } else {

            flash('user_message', 'Vous n\'êtes pas administrateur');
            return redirect('home.index');
        }
    }

}