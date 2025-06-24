<?php

namespace App\Models;
use App\Models\Advert;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $table = "estates";
    public $timestamps=false;

       public function Advert(){
        return $this->belongsTo(Advert::class);
    }
}
