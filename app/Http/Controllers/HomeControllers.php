<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeControllers extends Controller
{
    public function advert(){
        $category=Category::orderby('id','desc')->get();
        return view('advert',['category'=>$category]);
    }

    public function AdvertParent(Request $request){
        $id=$request->id;
        $category=Category::find($id);
        return $category;

    }

    public function Sendsubmenu(Request $request){
        //  $id = $request->id;
         $category = Category::where('parent_id','!=',0)->get();
         return $category;
    }

    public function subcats(Request $request){
        $id = $request->id;
        $category = Category::where('parent_id',$id)->where('parent_id','!=',0)->get();
         return $category;
    }

    public function catmenus(Request $request){


    }
}
