@extends('layouts.userlayout')

@section('content')

<div class="card" style="height: 100px;font-size: 17px;font-weight: bold;margin-top: 35px;padding-top: 3%;padding-right: 6%;direction: rtl;position: absolute;width: 70%;left: 15%;">
    {{$category->name}}
</div>

<div class="card" style="min-height:400px;margin-top: 15px; text-align:right;padding-top:15px;font-size: 15px; margin-top: 150px;direction: rtl; position: absolute;width: 70%;left: 15%;">

   <form action="/editadvert" method="POST">
        @csrf

        <div class="col-lg-12" style="float: right;">
            <div class="col-lg-6" style="float: right;">
                <div class="form-group">
                    <label for="">شهر</label>
                    <select name="city" class="form-control">
                        <option data-display="{{$advert->city}}">{{$advert->city}}</option>
                        <option value="کابل">کابل</option>
                        <option value="هرات">هرات</option>
                        <option value="غزنی">غزنی</option>
                        <option value="مزار شریف">مزار شریف</option>
                        <option value="قندهار">قندهار</option>
                        <option value="میدان وردک">میدان وردک</option>
                        <option value="بامیان">بامیان</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="advert_id" value="{{$id}}">
            <input type="text" style="position:absolute;display:none;" id="category">

            <div class="col-lg-10" style="float: right;">
                <div class="form-group">
                    <label for="">نقشه</label>
                </div>
            </div>

            <div class="col-lg-4" style="float: right;">
                <div class="form-group">
                    <label for="">در اطراف شهر</label>
                    <input class="form-check-input" type="checkbox" name="aroundCity">                                      
                </div>
            </div>

            <div class="col-lg-12" style="float: right;">
                <div class="form-group">
                    <label for="">تصاویر</label>   

                </div>
            </div>

          
            <div class="col-lg-12" style="float: right; margin-top: 230px;">
                <div class="form-group">
                    <label for="">متراج (مترمربع)</label>
                    <input type="text" name="area" value="{{ $estate->area ?? '' }}" class="form-control">
                </div>
            </div>
           

            <div class="col-lg-12" style="float: right;">
                <div class="form-group">
                    <label for="">نوع آگهی</label>
                </div>
            </div>

            <div class="col-lg-2" style="float: right;">
                <div class="form-group">
                    <input class="form-check-input" type="radio" name="adType" value="0"> ارایه
                </div>
            </div>

            <div class="col-lg-2" style="float: right;">
                <div class="form-group">
                    <input class="form-check-input" type="radio" name="adType" value="1"> درخواستی
                </div>
            </div>

            <div class="col-lg-12" style="float: right;">
                <div class="form-group">
                    <label for="">نوع آگهی دهنده</label>
                </div>
            </div>

            <div class="col-lg-2" style="float: right;">
                <div class="form-group">
                    <input class="form-check-input" type="radio" name="advertiser" value="0"> شخصی
                </div>
            </div>

            <div class="col-lg-2" style="float: right;">
                <div class="form-group">
                    <input class="form-check-input" type="radio" name="advertiser" value="1"> مشاور املاک                                     
                </div>
            </div>

            <div class="col-lg-4" style="float: right;left: 33%;margin-top: 82px;">
                <div class="form-group">
                    <label for="">گروی(افغانی)</label>
                    <select name="deposite_type" class="form-control">
                        <option value="custom">قیمت مورد نظر</option>
                        <option value="free">مجانی</option>
                        <option value="contact">توافقی(تماس بگیرید)</option>
                    </select>                                     
                </div>
            </div>

            @if($estate->deposite)
            <div class="col-lg-8" style="float: left;margin-top: -49px;">
                <div class="form-group">
                    <input type="text" name="deposite" value="{{$estate->deposite}}" class="form-control">
                </div>
            </div>
            @endif

            <div class="col-lg-4" style="float: right;">
                <div class="form-group">
                    <label for="">کرایه(افغانی)</label>
                    <select name="rent_type" class="form-control">
                        <option value="custom">قیمت مورد نظر</option>
                        <option value="free">مجانی</option>
                        <option value="contact">توافقی(تماس بگیرید)</option>
                    </select>                                     
                </div>
            </div>

            @if($estate->rent)
            <div class="col-lg-8" style="float: left;margin-top: 28px;">
                <div class="form-group">
                    <input type="text" name="rent" value="{{$estate->rent}}" class="form-control">
                </div>
            </div>
            @endif

            @if($estate->number)
            <div class="col-lg-12" style="float: left;margin-top: 28px;">
                <label for="">تعداد اتاق</label>
                <div class="form-group">
                    <select name="numberRoom" class="form-control">
                        <option data-display="{{$estate->number}}" value="{{$estate->number}}">{{$estate->number}}</option> 
                        <option value="">بدون اتاق</option>
                        <option value="1">یک اتاق</option>
                        <option value="2">دو اتاق</option>
                        <option value="3">سه اتاق</option>
                        <option value="4">چهار اتاق</option>
                        <option value="5+">پنج اتاق یا بشتر</option>
                    </select>
                </div>
            </div>
            @endif

            @if($advert->mobile)
            <div class="col-lg-12" style="float: left;margin-top: 28px;">
                <div class="form-group">
                    <label for="">شماره موبایل</label>
                    <input type="text" name="mobile" value="{{$advert->mobile}}" class="form-control" placeholder="شماره موبایل شما(*********0093)">
                    <span style="color: #9a9090 ;">کد تایید به شماره شما ارسال خواهد شد. تماس و چت نیز با این شماره انجام میشود</span>
                </div>
            </div>
            @endif

            <div class="col-lg-6" style="float: right;">
                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="chatEnabled" value="1">  
                    چت برنامه فعال شود                                         
                </div>
            </div>

            @if($advert->email)
            <div class="col-lg-12" style="float: left;margin-top: 28px;">
                <div class="form-group">
                    <label for="">ایمیل </label>
                    <input type="email" name="email" value="{{$advert->email}}" class="form-control" placeholder="******@gmail.com">
                    <span style="color: #9a9090 ;">آدرس ایمیل خود را به درستی وارید کنید. لینک "مدریت آگهی" به ایمیل تان ارسال میشه</span>
                </div>
            </div>
            @endif

            <div class="col-lg-6" style="float: right;">
                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="noemail" value="1">  
                    ایمیل در آگهی نمایش داده شود                                         
                </div>
            </div>

            @if($advert->subject)
            <div class="col-lg-12" style="float: left;margin-top: 28px;">
                <div class="form-group">
                    <label for="">عنوان آگهی </label>
                    <input type="text" name="subject" value="{{$advert->subject}}" class="form-control">
                    <span style="color: #9a9090 ;">از عنوان های مفید و کوتاه استفاده کنید. اشاره به محل ملک و متراج باعث دیده شدن بشتر آگهی میشود</span>
                </div>
            </div>
            @endif

            @if($advert->text)
            <div class="col-lg-12" style="float: left;margin-top: 28px;">
                <div class="form-group">
                    <label for="">توضیحات آگهی</label>
                    <textarea name="text" class="form-control">{{$advert->text}}</textarea>
                    <span style="color: #9a9090 ;">جزئیات کامل در باره آگهی خود بنویسید. شانس موفقیت آگهی تان را بالا می‌برد</span>
                </div>
            </div>
            @endif

            <div class="col-lg-12" style="margin-bottom: 20px;" >
                <div class="form-group" style="float:left;">
                    <input type="hidden" value="{{$id}}" name="advert_id">

                     <div id="editimage"></div>

                    <button type="submit" class="btn btn-danger" style="font-size: 13px;padding: 12px 40px;">
                        ذخیره کردن تغیرات
                    </button>
                </div>
            </div>

        </div> 
    </form>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


                        
    <form action="/editimage" method="post" class="dropzone" id="myDropzone1" style="position: absolute;width: 90%;left: 5%;top: 14%;">
        @csrf
    </form>

</div>

@endsection
