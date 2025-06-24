<?php

namespace App\Models;
use App\Models\Estate;
use App\Models\Car;
use App\Models\User;
use App\Models\Image;
use App\Models\Chat;
use App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $table = "adverts";
    public $timestamps=false;

    public function Estate(){
        return $this->hasOne(Estate::class);
    }
    public function Car(){
        return $this->hasOne(Car::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Image(){
        return $this->hasMany(Image::class);
    }
    public function Chat(){
        return $this->belongsToMany(Chat::class);
    }
    public function Category(){
        return $this->belongsToMany(Category::class);
    }
}
