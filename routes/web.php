<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admincontrollers;
use App\Http\Controllers\CategoryControllers;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\AdvertControllers;
use App\Http\Controllers\ManageControllers;

Route::get('/', function () {
    return view('user');
});


// Route::get('/user/update/{id}',[OrderControllers::class, 'update']);  

Route::get('admin/index',[AdminControllers::class,'index']);

Route::get('admin/category',[CategoryControllers::class,'index']);

Route::post('addcategory',[CategoryControllers::class,'addcategory']);

Route::post('removecategory',[CategoryControllers::class,'removecategory']);

Route::get('getcatagory',[CategoryControllers::class,'getcatagory']);

Route::get('advert',[HomeControllers::class,'advert']);

Route::post('parent',[HomeControllers::class,'AdvertParent']);

Route::post('Sendsubmenu',[HomeControllers::class,'Sendsubmenu']);

Route::post('subcats',[HomeControllers::class,'subcats']);

Route::post('send_advert2',[HomeControllers::class,'send_advert2']);

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


