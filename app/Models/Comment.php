<?php

namespace App\Models;
use App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    public $timestamps=false;
    public function Post(){
        return $this->belongsTo(Post::class);
    }
}
