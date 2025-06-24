<?php

namespace App\Models;
use App\Models\User;
use App\Models\Advert;
use App\Models\Chateimage;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "chats";
    public $timestamps=false;

    public function User(){
        return $this->belongsToMany(User::class);
    }
    public function Advert(){
        return $this->belongsToMany(Advert::class);
    }
    public function Chateimage(){
        return $this->hasMany(Chateimage::class);
    }
}
