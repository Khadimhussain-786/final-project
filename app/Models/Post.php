<?php

namespace App\Models;
use App\Models\Comment;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    public $timestamps=false;

    public function Comment(){
        return $this->hasMany(Comment::class);
    }
}
