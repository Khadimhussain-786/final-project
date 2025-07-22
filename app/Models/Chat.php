<?php

namespace App\Models;
use App\Models\User;
use App\Models\Advert;
use App\Models\Chateimage;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    protected $fillable=['chat_text','date','chat_image','user_id','status','advert_id','receiver_id'];

    protected $table = "chats";
    public $timestamps=false;

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Advert(){
        return $this->belongsTo(Advert::class);
    }
    public function Chateimage(){
        return $this->hasMany(Chateimage::class);
    }

    public function getSelfMessageAttribute(){
        return $this->user_id === auth()->user()->id;
    }
}
