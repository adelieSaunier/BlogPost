<?php
namespace App\models;
use Model;
class Post extends Model
{
    protected $guarded = [];
    protected $table = 'posts';

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function postComments(){
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}