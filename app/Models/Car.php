<?php

namespace App\Models;
use App\Models\Advert;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = "cars";
    public $timestamps=false;

    public function Advert(){
        return $this->belongsTo(Advert::class);
    }
}
