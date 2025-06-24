<?php

namespace App\Models;
use App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Chateimage extends Model
{
    protected $table = "chatimages";
    public $timestamps=false;
    public function Chat(){
        return $this->belongsTo(Chat::class);
    }
}
