@extends('layouts.userlayout')


@section('content')


 <aside class="sidebar">

     <div class="discription">
           <p>پایگاه خرید فروش بی واسطه. </p>
           <p>اگردنبال چیزی هستی، شهرت را انتخاب کن و از قسمت دسته بندی ها دنبالش بگرد. </p>
           <p>اگر هم میخواهی چیزی بیفروشی ، چند تا عکس ازش بگیر و بیچسپان اینجا. </p>
           <p>علاوه بر ویبسایت میتوانید از اپ در دستگاه های اندرویدی ،آیفون و آیپد هم استفاده کنید.</p>
     </div>
     
     <hr class="divider">
       <p style="font-weight: bold;font-size: 14px">برنامه را درشبکه های اجتماعی دنبال کنید:</p>
     <div class="social">

           <a href=""><i class="fa fa-twitter"></i></a>
           <a href=""><i class="fa fa-facebook"></i></a>
           <a href=""><i class="fa fa-instagram"></i></a>
       
     </div>

 </aside>

 <div class="col-lg-12" style="position: absolute;">

   <section class="col-lg-6" style="margin-top: 80px; margin-left: 7%;">
          <input type="text" class="form-control" style="text-align: right;" placeholder="جستجو سریع شهر...">
          <i class="fa fa-search" style="position: absolute;top: 10px;left: 23px;"></i>
        
        <section style="margin-top: 25px; margin-left: -14px;"  id="button">
            <div class="col-lg-2">
                   <a href="#" class="button">
                      کابل
                   </a>
            </div>
            <div class="col-lg-2">
                   <a href="#" class="button">
                      کابل
                   </a>
            </div>
            <div class="col-lg-2">
                   <a href="#" class="button">
                      کابل
                   </a>
            </div>
            <div class="col-lg-2">
                   <a href="#" class="button">
                      کابل
                   </a>
            </div>
            <div class="col-lg-2">
                   <a href="#" class="button">
                      کابل
                   </a>
            </div>
        
        </section>
         
   </section>

 </div>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" style="direction: rtl;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="height: 217px;">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="float: right;">انتخاب شهر</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" style="float: left; position: absolute;left: 7px;" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <input type="text" class="form-control" style="text-align: right;" placeholder="جستجو سریع شهر...">
            <i class="fa fa-search" style="position: absolute;top: 22px;left: 23px;"></i>
            <section style="margin-top: 25px; margin-left: -14px; margin: bottom 87px;"  id="buttons">
            <div class="col-lg-2">
                   <a href="#" class="buttons">
                      کابل
                   </a>
            </div>
            <div class="col-lg-2">
                   <a href="#" class="buttons">
                      کابل
                   </a>
            </div>
            <div class="col-lg-2">
                   <a href="#" class="buttons">
                      کابل
                   </a>
            </div>
            <div class="col-lg-2">
                   <a href="#" class="buttons">
                      کابل
                   </a>
            </div>
            <div class="col-lg-2">
                   <a href="#" class="buttons">
                      کابل
                   </a>
            </div>
        
            </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection