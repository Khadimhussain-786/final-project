@extends('layouts.userlayout')


@section('content')

<div class="col-lg-12" style="direction: rtl;margin-top: -50px;">
   <div class="col-lg-9" style=" float: right;right: 13%;">
      <div class="advert-title"><h3>ارسال رایگان آگهی</h3></div>
       <div class="card" style="height: 500px;    margin-top: 20px;">

             <ul class="send-advert" style="padding-right: 40px;">
              <li v-for="category in categorys" @click="SendAvert(category.id)">@{{category.name}}</li>
              
           </ul>
           
           <ul class="send-advert1" style="padding-right: 40px;" v-if="showSecondUl">
                <li  ><i class="fa fa-angle-right"></i><h5>@{{advertcat.name}}</h5></li>

                <li v-for="submenu in submenus" @click="Sendsubmenu(submenu.id)">
                   <span v-if="submenu.parent_id == advertcat.id"> @{{submenu.name}} </span>
                </li>
            </ul>


            <!-- <span v-for="menus in menu">
              <ul class="send-advert2" style="padding-right: 40px;" v-if="submenu in submenus">
                <li><i class="fa fa-angle-right"></i><h5>@{{advertcat.name}}</h5></li>        
                    <span v-if="submenu.id == menus.parent_id"> 
                           <li v-for="">
                                @{{menus.name}} 
                            </li>
                    </span>
              </ul>
            </span> -->

                <!-- ul سوم - فقط این بخش تغییر کرده -->
                
                        <ul class="send-advert2" style="padding-right: 40px;" v-if="menu.length > 0">
                            <li><i class="fa fa-angle-right"></i><h5>@{{submenuSelectedName}}</h5></li>        
                            <li v-for="menus in menu" v-if="menus.parent_id == submenuSelectedId" @click="send_advert2(menus.id)">
                                @{{ menus.name }} 
                            </li>
                        </ul>

       </div>
   </div>
</div>

@endsection