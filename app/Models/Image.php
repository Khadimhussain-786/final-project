<?php

namespace App\Models;
use App\Models\Advert;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";
    public $timestamps=false;

    public function Advert(){
        return $this->belongsTo(Advert::class);
    }
}
