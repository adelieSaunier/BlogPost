<?php
namespace App\models;

use Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];

    protected $fillable = [
        'title',
        'content',
        'status',
        'user_id',
        'post_id',
        
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}