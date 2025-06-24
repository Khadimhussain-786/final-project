<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admincontrollers extends Controller
{
    public function index(){
        return view('admin.index');
    }
}
