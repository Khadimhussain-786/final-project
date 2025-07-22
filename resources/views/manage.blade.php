<?php 

use App\Lip\Helper;

?>

@extends('layouts.userlayout')

@section('content')


  
            <div class="progress-manage progress">

                    <ul style="padding-left: 0;">
                        <li class="completed" style="margin-right: 0 !important; text-align:right;" >
                            <span class="progress" style="background-color: green !important;"></span>
                            <div class="circle" style="background-color: green;"></div>
                            <p> ثبت شده</p>
                        </li>
                        

                        <li class="warning" style="text-align:right;">
                            <span id="progress" class="progress" style="background-color: #edb10a !important;"></span>
                            <div id="progress" class="circle" style="background-color: #edb10a;"></div>
                            <p>تایید شماره</p>
                        </li>
                       
                          
                        @if ($advert->check==1)

                         <li class="wating" style="text-align: right;">
                            <span  class="progress" style="background-color:green !important;"></span>
                            <div  class="circle" style="background-color: green !important;"></div>
                            <p>در اتظاره برسی </p>   
                        </li>

                        <li class="end" style="text-align: left;width: 3% !important;">
                            <span id="progress" class="progress" style="background-color: green;"></span>
                            <div id="progress" class="circle" style="background-color: green;"></div>
                            <p> انتشار</p>    
                        </li>
 
                            @else
                         <li class="wating" style="text-align: right;">
                            <span id="progress" class="progress" style="background-color:#bbb ;"></span>
                            <div id="progress" class="circle" style="background-color: #bbb ;"></div>
                            <p>در اتظاره برسی </p>   
                         </li>

                         <li class="end" style="text-align: left;width: 3% !important;">
                            <span id="progress" class="progress" style="background-color: #bbb;"></span>
                            <div id="progress" class="circle" style="background-color: #bbb;"></div>
                            <p> انتشار</p>    
                         </li>

                        @endif

                        
                    </ul>

            </div>


            <div class="manage-text">
                <p>پیام کوتاهی شامل کد به منظور تایید شماره  تماس شما فرستاده خواهد شد. لطفا کد را اینجاوارید کنید</p>

                <div class="col-lg-6" style="position: absolute; right:31%; margin-top:42px;">

                </div>
                    <div class="form-group">
                        <label style="float: right;margin-right: 46%;margin-top: 30px;">کد تایید</label>

                            <input type="text" v-model="code" style="width: 50%;margin: auto;margin-bottom: 5px;" class="form-control">

                            <input type="submit" @click="statuscode()" class="btn btn-success" value="تایید" id="btn">
                        
                    </div>
            </div>

            <!-- Nav tab -->

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home">پیش نمایش</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/edit/{{$category_id}}/{{$id}}">ویرایش</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#menu2">ارتقا</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#menu3">حذف</a>
            </li>
        </ul>


            <!-- tab panes -->







             <div class="tab-content">
                <div class="tab-pane col-lg-12 show active" id="home"> 
                    
            
                      <div class="">
                            <div class="col-lg-7" style="margin-right: 30px; float:right;">
                                <div class="card" style="text-align: right; padding-right:16px; padding-top:21px;">
                                    <span style="font-weight: bold; font-size:34px;">{{$advert->subject}}</span>
                                    <p style="margin-top:32px; font: size 18px;">dates</p>
                                </div>
                            </div>
                    
                    
                    
                            <div class="col-lg-7" style="margin-right: 30px; margin-top:10px;float:right; font-size:15px;">
                                <div class="card" style="text-align: right; padding-right:16px; padding-top:21px;">
                                    <div class="header" style="border-bottom: 1px solid #000; padding-bottom: 7px; margin-left:10px;">مشخصات</div>
                                    <ul class="content">
                                        <li class="right">ایمیل :  {{$advert->email}}</li>
                                        <li class="left">شماره : {{$advert->mobile}}</li>
                                        <li class="right">شهر :  {{$advert->city}}</li>
                                        {{Helper::Estate($id) }}
                                        {{Helper::Car($id) }}       
                                        
                                    </ul>
                                </div>
                            </div>
                    
                            
                            <div class="col-lg-7" style="margin-right: 30px; margin-top:10px;float:right; font-size:15px;">
                                <div class="card" style="text-align: right; padding-right:16px; padding-top:21px;">
                                    <div class="header" style="border-bottom: 1px solid #000; padding-bottom: 7px; margin-left:10px;">توضحات</div>
                                    <p style="margin: 15px 5px;">{{$advert->text}}</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4" style="position: absolute; left:40px; top:0;">
                                <div class="card" style="height: 400px;background-color: #e9e8e8; border:none;">
                    
                                <div id="carouselAdvert{{ $id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            {{ Helper::Images($id) }}
                                        </div>

                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAdvert{{ $id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">قبلی</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselAdvert{{ $id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">بعدی</span>
                                        </button>
                                    </div>

                                </div>
                            </div>



                        </div>
            
            
                </div>


                <div class="tab-pane fade" id="menu2"> ... </div>


                <div class="tab-pane col-lg-12 " id="menu3">
                    
                  
                    <div class="card" style="padding: 20px; margin-top: 20px; text-align: center;">
                        <form action="/deleteadvert" method="post" onsubmit="return confirm('آیا از حذف آگهی اطمینان دارید؟');">
                            @csrf
                            <input type="hidden" value="{{ $advert->id }}" name="advert_id">
                            <button type="submit" class="btn btn-danger btn-lg">حذف آگهی</button>
                        </form>
                    </div>
            
            
                </div>
            </div>





            @if ($advert->status == 1)
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        
                        document.querySelector('.manage-text').style.display = 'none';

                      
                        document.querySelectorAll('.warning #progress').forEach(el => el.style.backgroundColor = 'green');
                        document.querySelectorAll('.wating #progress').forEach(el => el.style.backgroundColor = '#edb10a');
                    });
                </script>
            @endif


@endsection