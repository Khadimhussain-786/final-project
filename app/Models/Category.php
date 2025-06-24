<?php

namespace App\Models;
use App\Models\Advert;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $table = "categories";
    public $timestamps=false;

    protected $fillable = ['name','parent_id'];

    public function Advert(){
        return $this->hasMany(Advert::class);
    }
}
