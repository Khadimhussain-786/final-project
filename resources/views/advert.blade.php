@extends('layouts.userlayout')


@section('content')

<div class="col-lg-12" style="direction: rtl;margin-top: -50px;">
   <div class="col-lg-9" style=" float: right;right: 13%;">
      <div class="advert-title"><h3>ارسال رایگان آگهی</h3></div>
       <div class="card" id="card" style="height: 500px;    margin-top: 20px;">

             <ul class="send-advert" style="padding-right: 40px;">
              <li v-for="category in categorys" @click="SendAvert(category.id)">@{{category.name}}</li>
              
           </ul>
           
           <ul class="send-advert1" style="padding-right: 40px;" v-if="showSecondUl">
                <li  ><i class="fa fa-angle-right"></i><h5>@{{advertcat.name}}</h5></li>

                <li v-for="submenu in submenus" @click="Sendsubmenu(submenu.id)">
                   <span v-if="submenu.parent_id == advertcat.id"> @{{submenu.name}} </span>
                </li>
            </ul>

                
                        <ul class="send-advert2" style="padding-right: 40px;" v-if="menu.length > 0">
                            <li><i class="fa fa-angle-right"></i><h5>@{{submenuSelectedName}}</h5></li>        
                            <li v-for="menus in menu" v-if="menus.parent_id == submenuSelectedId" @click="send_advert2(menus.id)">
                                @{{ menus.name }} 
                            </li>
                        </ul>
                         
                        
       </div>
                 
                <ul class="send-advert3" style="padding-right: 40px;" v-if="showSendAdvert3">
                        <div class="card" style="height: 100px;font-size: 17px;font-weight: bold;padding-top: 4%;padding-right: 6%;">
        
                            @{{ category.name }}

                        </div>

                        <div class="card" style="min-height:400px;margin-top: 15px; text-align:right;padding-top:15px;font-size: 15px;">
                         
                               <!-- <span v-if="submenuSelected.parent_id ==1">
                               @include("layouts.CarsForm.CarsForm")
                            </span >
                             <span v-else-if="submenuSelected.parent_id ==3">
                               @include("layouts.FormAdvert.StateForm")
                            </span>
                              <span v-else>
                               @include("layouts.PublicForm.PublicForm")
                            </span > -->

                               
                           
                              <template v-if="submenuSelected && submenuSelected.parent_id !== null">

                             
                                 <div v-if="parseInt(submenuSelected.parent_id) === 1">
                                    @include("layouts.CarsForm.CarsForm")
                                 </div>
                                 <div v-else-if="parseInt(submenuSelected.parent_id) === 3">
                                    @include("layouts.FormAdvert.StateForm")
                                 </div>
                                 <div v-else>
                                    @include("layouts.PublicForm.PublicForm")
                                 </div>

                              </template>


                            </ul>

                       </div>
</div>

@endsection