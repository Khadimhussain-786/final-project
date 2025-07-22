@extends('layouts.userlayout')


@section('content')

<div class="col-lg-12" style="direction: rtl;margin-top: -50px;">
   <div class="col-lg-9" style=" float: right;right: 13%;">
      <div class="advert-title" style="margin-right: 50px;margin-bottom: 15px;"><h3>ارسال رایگان آگهی</h3></div>

      <div class="card" id="card" style="min-height: 500px; margin-top: 20px;">

         <!-- اول -->
         <ul class="send-advert" style="padding-right: 40px;">
            <li v-for="category in categorys" v-if="category.parent_id === 0" @click="SendAvert(category.id)">
               @{{ category.name }}
            </li>
         </ul>

         <!-- دوم -->
         <ul class="send-advert1" style="padding-right: 40px;" v-if="showSecondUl">
            <li><i class="fa fa-angle-right"></i><h5>@{{ advertcat.name }}</h5></li>
            <li v-for="submenu in submenus" @click="Sendsubmenu(submenu.id)">
               <span v-if="submenu.parent_id == advertcat.id"> @{{ submenu.name }} </span>
            </li>
         </ul>

         <!-- سوم -->
         <ul class="send-advert2" style="padding-right: 40px;" v-if="menu.length > 0">
            <li><i class="fa fa-angle-right"></i><h5>@{{ submenuSelectedName }}</h5></li>
            <li v-for="menus in menu"
                v-if="menus.parent_id == submenuSelectedId"
                @click="send_advert2(menus.id)">
               @{{ menus.name }}
            </li>
         </ul>
      </div>

      <!-- فرم تبلیغات-->
      <ul class="send-advert3" style="padding-right: 40px;" v-if="showSendAdvert3">
         <div class="card" style="height: 100px;font-size: 17px;font-weight: bold;padding-top: 4%;padding-right: 6%;">
            @{{ category.name }}
         </div>

         <div class="card" style="min-height:400px;margin-top: 15px; text-align:right;padding-top:15px;font-size: 15px;">
            <template v-if="category">
               <!-- املاک -->
               <div v-if="isInEstateCategory(submenuSelected.id ? submenuSelected : category)">
                  @include("layouts.FormAdvert.StateForm")
               </div>

               <!-- وسایل نقلیه -->
               <div v-else-if="isInCarCategory(submenuSelected.id ? submenuSelected : category)">
                  @include("layouts.CarsForm.CarsForm")
               </div>

               <!-- دسته‌ها -->
               <div v-else>
                  @include("layouts.PublicForm.PublicForm")
               </div>
            </template>
         </div>
      </ul>
   </div>
</div>

@endsection
