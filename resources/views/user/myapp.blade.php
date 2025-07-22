<?php 

use App\Lip\Helper;

?>

@extends('layouts.userlayout')
@section('content') 
      
      
      
      
      
      <ul class="nav nav-tabs myapp_nav_tap" >
            <li class="nav-item">
                <a class="nav-link active" style="color: #000 !important;" data-bs-toggle="tab" href="#home">تبلیغات من</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #000 !important;" data-bs-toggle="tab" href="#menu3">بازدید ها</a>
            </li>
        </ul>


            <!-- tab panes -->







             <div class="tab-content top_content_myapp">
                <div class="tab-pane col-lg-12 show active" id="home"> 
                    
            
                    {{Helper::myadvert($mobile) }}

                
            
                </div>


                <div class="tab-pane col-lg-12 " id="menu3">

                     <p>hello nothing to show</p>
             
                </div>
            </div>

 @endsection