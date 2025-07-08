<div class="col-lg-12" style="float: right;">
  <div class="col-lg-6" style="float: right;">
    <div class="form-group">
      <label for="">شهر</label>
      <select v-model="city" class="form-control">
        <option value="Select"></option>
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
       <input type="text" style="position:absolute;display:none;" v-bind:value="category.id" id="category">

  <div class="col-lg-10" style="float: right;">
    <div class="form-group">
      <label for="">نقشه</label>
    </div>
  </div>

  <div class="col-lg-4" style="float: right;">
    <div class="form-group">
      <label for="">در اطراف شهر</label>
      <input class="form-check-input" type="checkbox" v-model="aroundCity">                                      
    </div>
  </div>

  <div class="col-lg-12" style="float: right;">
    <div class="form-group">
      <label for="">تصاویر</label>
      <form action="/addimage" method="post" class="dropzone" id="myDropzone">
        @csrf
      </form>
    </div>
  </div>
  
  <div class="col-lg-12" style="float: right;">
    <div class="form-group">
      <label for="">متراج (مترمربع)</label>
      <input type="text" class="form-control" v-model="area">
    </div>
  </div>

  <div class="col-lg-12" style="float: right;">
    <div class="form-group">
      <label for="">نوع آگهی</label>
    </div>
  </div>

  <div class="col-lg-2" style="float: right;">
    <div class="form-group">
      <input class="form-check-input" type="radio" name="adType" value="0" v-model="adType"> ارایه
    </div>
  </div>

  <div class="col-lg-2" style="float: right;">
    <div class="form-group">
      <input class="form-check-input" type="radio" name="adType" value="1" v-model="adType"> درخواستی
    </div>
  </div>

  <div class="col-lg-12" style="float: right;">
    <div class="form-group">
      <label for="">نوع آگهی دهنده</label>
    </div>
  </div>

  <div class="col-lg-2" style="float: right;">
    <div class="form-group">
      <input class="form-check-input" type="radio" name="advertiser" value="0" v-model="advertiser"> شخصی
    </div>
  </div>

  <div class="col-lg-2" style="float: right;">
    <div class="form-group">
      <input class="form-check-input" type="radio" name="advertiser" value="1" v-model="advertiser"> مشاور املاک                                     
    </div>
  </div>

  <div class="col-lg-4" style="float: right;left: 33%;margin-top: 82px;">
    <div class="form-group">
      <label for="">گروی(افغانی)</label>
      <select v-model="feeType" class="form-control" @change="handleFeeChange">
        <option value="custom">قیمت مورد نظر</option>
        <option value="free">مجانی</option>
        <option value="contact">توافقی(تماس بگیرید)</option>
      </select>                                     
    </div>
  </div>

  <div class="col-lg-8" style="float: left;margin-top: -49px;">
    <div class="form-group">
      <input type="text" class="form-control" :disabled="feeType !== 'custom'" v-model="fee">
    </div>
  </div>

  <div class="col-lg-4" style="float: right;">
    <div class="form-group">
      <label for="">کرایه(افغانی)</label>
      <select v-model="rentType" class="form-control" @change="handleRentChange">
        <option value="custom">قیمت مورد نظر</option>
        <option value="free">مجانی</option>
        <option value="contact">توافقی(تماس بگیرید)</option>
      </select>                                     
    </div>
  </div>

  <div class="col-lg-8" style="float: left;margin-top: 28px;">
    <div class="form-group">
      <input type="text" class="form-control" :disabled="rentType !== 'custom'" v-model="rent">
    </div>
  </div>

  <div class="col-lg-12" style="float: left;margin-top: 28px;">
    <label for="">تعداد اتاق</label>
    <div class="form-group">
      <select class="form-control" v-model="numberRoom">
        <option value="">بدون اتاق</option>
        <option value="1">یک اتاق</option>
        <option value="2">دو اتاق</option>
        <option value="3">سه اتاق</option>
        <option value="4">چهار اتاق</option>
        <option value="5+">پنج اتاق یا بشتر</option>
      </select>
    </div>
  </div>

  <div class="col-lg-12" style="float: left;margin-top: 28px;">
    <div class="form-group">
      <label for="">شماره موبایل</label>
      <input type="text" class="form-control" placeholder="شماره موبایل شما(*********0093)" v-model="phone">
      <span style="color: #9a9090 ;">کد تایید به شماره شما ارسال خواهد شد. تماس و چت نیز با این شماره انجام میشود</span>
    </div>
  </div>

  <div class="col-lg-6" style="float: right;">
    <div class="form-group">
      <input class="form-check-input" type="checkbox" :value="1" v-model="chatEnabled">  
      چت برنامه فعال شود                                         
    </div>
  </div>

  <div class="col-lg-12" style="float: left;margin-top: 28px;">
    <div class="form-group">
      <label for="">ایمیل </label>
      <input type="email" class="form-control" placeholder="******@gmail.com" v-model="email">
      <span style="color: #9a9090 ;">آدرس ایمیل خود را به درستی وارید کنید. لینک "مدریت آگهی" به ایمیل تان ارسال میشه</span>
    </div>
  </div>

  <div class="col-lg-6" style="float: right;">
    <div class="form-group">
      <input class="form-check-input" type="checkbox" :value="1" v-model="emailVisible">  
      ایمیل در آگهی نمایش داده شود                                         
    </div>
  </div>

  <div class="col-lg-12" style="float: left;margin-top: 28px;">
    <div class="form-group">
      <label for="">عنوان آگهی </label>
      <input type="text" class="form-control" v-model="title">
      <span style="color: #9a9090 ;">از عنوان های مفید و کوتاه استفاده کنید. اشاره به محل ملک و متراج باعث دیده شدن بشتر آکهی میشود</span>
    </div>
  </div>

  <div class="col-lg-12" style="float: left;margin-top: 28px;">
    <div class="form-group">
      <label for="">توضیحات آگهی</label>
      <textarea class="form-control" v-model="description"></textarea>
      <span style="color: #9a9090 ;">جزایات کامل در باره آگهی خود بنوسید. شانس موفقیت آگهی تان را بالا میبرد </span>
    </div>
  </div>

   
      <div class="col-lg-12" style="margin-bottom: 20px;" >
          <div class="form-group" style="float:left;">
            
            <form action="/addimage" method="post">
                    @csrf
                  <button type="button" class="btn btn-danger" @click="addstate()" style="font-size: 13px;padding: 12px 40px;">
                  ارسال رایگان آگهی
                  </button>
            </form>

          </div>
      </div>


</div>


