<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admincontrollers;
use App\Http\Controllers\CategoryControllers;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\AdvertControllers;
use App\Http\Controllers\ManageControllers;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('user');
});


// Route::get('/user/update/{id}',[OrderControllers::class, 'update']);  

/*****admin*****/

Route::get('admin/index',[AdminControllers::class,'index']);

Route::get('manageadvert',[AdminControllers::class,'manageadvert']);

Route::post('removeadvert',[AdminControllers::class,'removeadvert']);

Route::post('chechadvert',[AdminControllers::class,'chechadvert']);

Route::get('user',[AdminControllers::class,'user']);

Route::post('/admin/adduser',[AdminControllers::class,'adduser']);

Route::get('/admin/showuser',[AdminControllers::class,'showuser']);

Route::post('/admin/checkuser',[AdminControllers::class,'checkuser']);

Route::post('/admin/changerole',[AdminControllers::class,'changerole']);






Route::get('admin/category',[CategoryControllers::class,'index']);

Route::post('addcategory',[CategoryControllers::class,'addcategory']);

Route::post('removecategory',[CategoryControllers::class,'removecategory']);

Route::get('getcatagory',[CategoryControllers::class,'getcatagory']);





Route::get('advert',[HomeControllers::class,'advert']);

Route::post('parent',[HomeControllers::class,'AdvertParent']);

Route::post('Sendsubmenu',[HomeControllers::class,'Sendsubmenu']);

Route::post('subcats',[HomeControllers::class,'subcats']);

Route::post('send_advert2',[HomeControllers::class,'send_advert2']);



/*******addmobile*******/
Route::post('addmobile',[HomeControllers::class,'addmobile']);

Route::post('checkCode',[HomeControllers::class,'checkCode']);
        /**chat**/
Route::post('addmobile_chat',[HomeControllers::class,'addmobile_chat']);

Route::post('checkCode_chat',[HomeControllers::class,'checkCode_chat']);

Route::get('myapp',[HomeControllers::class,'myapp']);







Route::post('addstate',[AdvertControllers::class,'addstate']);

Route::post('addimage',[AdvertControllers::class,'addimage']);

Route::post('addcares',[AdvertControllers::class,'addcares']);

Route::post('addpublic',[AdvertControllers::class,'addpublic']);

Route::post('statuscode',[AdvertControllers::class,'statuscode']);

Route::get('manage/{category_id}/{id}',[ManageControllers::class,'manage'])->name('manage');

Route::get('edit/{category_id}/{id}',[ManageControllers::class,'edit']);

Route::post('editadvert',[ManageControllers::class,'editadvert']);

Route::post('editimage',[ManageControllers::class,'editimage']);

Route::post('deleteadvert',[ManageControllers::class,'deleteadvert']);


/********show advert********/

Route::get('city/{city}',[ShowController::class,'index']);

Route::get('showadvert',[ShowController::class,'showadvert']);

Route::post('show',[ShowController::class,'show']);


/*******chat********/
  
// Route::get('chat/{id}',[ChatController::class,'chat']);

Route::get('chat',[ChatController::class,'chat']);

Route::get('private-messages/{user}',[ChatController::class,'privateMessages']);
Route::post('private-messages/{user}',[ChatController::class,'sendPrivateMessages']);



Route::get('showusers',[ChatController::class,'showusers']);

Route::post('sendmessage/{user}',[ChatController::class,'sendmessage']);


