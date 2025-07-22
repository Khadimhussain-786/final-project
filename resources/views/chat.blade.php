

@extends('layouts.userlayout')

@section('content')

     @if (empty(Session::get('verified_mobile')))

     <div id="loginContainer" class="container my-5" style="max-width: 600px;">
         <div class="modal-content p-4 shadow" style="border-radius: 16px; font-size: 1.1rem;">

             <div class="modal-header border-0">
                 <h4 class="modal-title w-100 text-center fw-bold" style="cursor: pointer;">ورود به حساب کاربری</h4>
             </div>

             <div class="modal-body text-center px-4">

                 <!-- مرحله اول -->
                 <div id="step1">
                     <p class="mb-3" style="font-size: 1.2rem;">شمارهٔ موبایل خود را وارد کنید</p>
                     <p class="text-muted mb-4">برای چت کردن، لطفاً شماره موبایل خود را وارد کنید. کد تأیید به این شماره ارسال خواهد شد.</p>

                     <div class="input-group mt-3 mb-3" dir="ltr" style="max-width: 400px; margin: 0 auto;">
                         <span class="input-group-text">+93</span>
                         <input type="text" id="mobile" class="form-control text-end" placeholder="شمارهٔ موبایل">
                     </div>

                     <button onclick="goToStep2Login()" class="btn btn-danger w-100 py-2 mt-3" @click = "addmobile_chat()" style="font-size: 1.2rem;">تأیید</button>
                 </div>

                 <!-- مرحله دوم -->
                 <div id="step2" class="d-none">
                     <p class="mb-3" style="font-size: 1.2rem;">کد تأیید را وارد کنید</p>
                     <p class="text-muted">کد پیامک‌شده به شماره <span id="showMobile"></span> را وارد کنید.</p>

                     <div class="input-group mt-3 mb-3" dir="ltr" style="max-width: 400px; margin: 0 auto;">
                         <input type="text" class="form-control text-center" v-model="logincod" placeholder="کد تأیید ۶ رقمی">
                     </div>

                     <div class="d-flex justify-content-between align-items-center mb-3" style="max-width: 400px; margin: 0 auto;">
                         <button onclick="backToStep1Login()" class="btn btn-light btn-sm">تغییر شماره موبایل</button>
                         <span class="text-muted small">درخواست مجدد کد</span>
                     </div>

                     <button class="btn btn-danger w-100 py-2" @click = "checkCode_chat()" style="font-size: 1.2rem;">ورود</button>
                 </div>

             </div>
         </div>
     </div>

     @else

      <div class="col-lg-10 chat_contaner">
        <div class="chat">

          <?php
          
          $receiver_id = App\Models\User::find(auth()->user()->u_id)->messages()->first()->receiver_id;
          
          ?>
 
            <user-log :advert_chat="advert_chat" :r_id="{{ $receiver_id }}" :user_id="{{auth()->user()->u_id}}"></user-log>


        </div>
      </div>
         
     @endif


      <!-- Modal -->

<div class="modal fade" id="chatemodal" tabindex="-1" aria-hidden="true" style="direction: rtl;">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content profile-modal">
      
      <div class="profile-header">
        پروفایل کاربری
        <p class="edit">ورایش</p>
         <div class="profile-user-info">
          <i class="fa fa-user-circle"></i>
          <div>
            <div class="user-name">خادم حسین حیدری</div>
            <div class="user-phone"> <i class="fa fa-phone"></i>{{Session::get('verified_mobile')}}</div>
          </div>
        </div>
        
      </div>

      <div class="profile-body">
       

        <ul class="profile-settings">
          <li>
            <span><i class="fa fa-ban"></i> نمایش مسدودشده‌ها</span>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" checked>
            </div>
          </li>
          <li>
            <span><i class="fa fa-comments"></i> نمایش مکالمات آگهی‌های حذف‌شده</span>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox">
            </div>
          </li>
          <li>
            <span><i class="fa fa-bullhorn"></i> نمایش هشدار هنگام حضور در برنامه</span>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" checked>
            </div>
          </li>
          <li>
            <span><i class="fa fa-paper-plane"></i> ارسال پیامک درصورت عدم مراجعه</span>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox">
            </div>
          </li>
        </ul>

        <div class="logout-button">
          <i class="fa fa-sign-out"></i> خروج از سیستم
        </div>
      </div>
    </div>
  </div>
</div>



@endsection