<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryControllers extends Controller
{
      public function index(){
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }
       
    public function addcategory(Request $request){
            //  return $request->Namecategory;
            $data=$request->all();
            $c=Category::create($data);

            if($c){
                  return $c;
            }
    }

    public function removecategory(Request $request){
            $c = Category::find($request->id)->delete();
            return redirect('/admin/category');
    }

        public function getcatagory()
        {
        // return Category::where('parent_id', 0)->get();
        return Category::all();
        }

}
