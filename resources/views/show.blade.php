
<?php 

use App\Lip\Helper;

?>
@extends('layouts.userlayout')

@section('content')



<aside class="aside_advert" v-show="asideVisible" >
    <div class="col-lg-2" style="position: absolute;">

         <div style="margin-bottom: 15px;color: #8f5102;">
          <h3> دسته بندی ها</h3>
         </div>

              <div class="advert_header" v-if="selectedMainCategory">
                <button @click="selectedMainCategory = null; selectedCategoryId = null">
                    همه تبلیغات
                </button>
              </div>
                
            <!-- دسته‌های اصلی -->
                  <ul class="main-categories">
                    <li 
                      v-for="cat in categorys" 
                      v-if="cat.parent_id === 0 && (!selectedMainCategory || selectedMainCategory.id === cat.id)"
                      @click="selectMainCategory(cat)"
                      :class="{ active: selectedMainCategory && selectedMainCategory.id === cat.id }"
                    >
                      @{{ cat.name }}
                    </li>
                  </ul>


            <!-- زیر‌دسته‌ها فقط زمانی که دسته اصلی انتخاب شده -->
            <ul class="sub-categories" v-if="selectedMainCategory">
                <li v-for="sub in subCategories" 
                    @click="selectSubCategory(sub)"
                    :class="{ active: selectedCategoryId === sub.id }">
                    @{{ sub.name }}
                </li>
            </ul>

    </div>
</aside>

<section>



  
        <div class="content col-lg-8" v-show="contentVisible"  style="padding-left: 0;">

            <ul class="show_advert" style=" margin-top: -75px;">
                    <div class="search_advert">
                      <i class="fa fa-search"></i>
                      <input type="text" v-model="searchQuery" class="form-control" placeholder="جستجو...">
                    </div>

              <li v-for="adverts in filteredAdverts"  @click = "Showadverts(adverts.id)" style="position: relative; cursor:pointer;">
                  <div class="advert_subject" >
                    @{{ adverts.subject }}
                  </div>
                  <div class="advert_image">
                      <img :src="'/uploads/' + adverts.image" alt="">
                  </div>

                  <div class="advert_chat">
                      <span v-if="adverts.chat == 1">
                        <p>چت</p>
                      </span>
                      <span v-else></span>
                  </div>

                  <div class="advert_date">
                      @{{ adverts.date_diff }}
                  </div>

                  <div class="advert_price">
                    <template v-if="adverts.car_price">
                      قیمت: @{{ adverts.car_price }} افغانی
                    </template>

                    <template v-else-if="adverts.estate_deposit || adverts.estate_rent">
                      گروی: @{{ adverts.estate_deposit || 0 }} افغانی -
                      کرایه: @{{ adverts.estate_rent || 0 }} افغانی
                    </template>

                    <template v-else>
                      قیمت:  @{{ adverts.price }} افغانی
                    </template>
                  </div>

              </li>


              
                <p v-if="filteredAdverts.length === 0 && searchQuery.trim() !== ''" class="no-find-message">
                  
                  <span>
                    <i class="fa fa-search-minus"></i> 
                    هیچ تبلیغات یافت نشد
                  </span>
               </p>
              
                  <p v-else style="color: #985353;margin-top: 50px;font-size: 16px;">
                    <infinite-loading @infinite="infiniteHandler" spinner="spiral">
                        <span slot="no-more"  >تبلیغات تمام شد</span>
                        <span slot="no-results">هیچ تبلیغات یافت نشد</span>
                    </infinite-loading>
                  </p>
                    




            </ul>


        
        </div>


      <div class="show" :class="{ 'hidden-force': !showVisible }" style="direction: rtl;"> 
           <div class="show_back">
                  <span class="show_back1" @click="show_back1()"> بازگشت</span>
                </div>

      
       <div class="show_header">
              <h3>
                @{{ show.subject }}
              </h3>
            </div>

            <div class="show_mobiel">
              <button type="button" class="btn_call"><i style="margin-left: 11px;color: green;" class="fa fa-phone"></i>دریافت اطلاعات تماس</button>
                <!-- <a :href="'/chat/' + show.Id">
                </a> -->
                
                <button data-bs-toggle="modal" :data-bs-target="'#chatemodal'+show.Id"  type="button" class="btn_chat" ><i style="margin-left: 11px;color: green;" class="fa fa-comment"></i>چت کردن </button>
            </div>

            <div class="show_content">      
              <ul>
                <li v-if="show.name">
                  <span>دسته‌بندی</span>
                  <span style="float: left;">@{{ show.name }}</span>
                </li>

                <li v-if="show.city">
                  <span>مکان</span>
                  <span style="float: left;">@{{ show.city }}</span>
                </li>

                <li v-if="show.type !== null && show.type !== undefined || show.car_type !== null && show.car_type !== undefined">
                  <span>نوع تبلیغات</span>
                  <span style="float: left;">
                    <span v-if="show.type == 0 || show.car_type == 0">فروشی</span>
                    <span v-else-if="show.type == 1 || show.car_type == 1">درخواستی</span>
                    <span v-else>کرایی</span>
                  </span>
                </li>


                <li v-if="show.typeAdvert !== null && show.typeAdvert !== undefined">
                  <span>تبلیغ‌دهنده</span>
                  <span style="float: left;">
                    <span v-if="show.typeAdvert == 0">شخصی</span>
                    <span v-else-if="show.typeAdvert == 1">راهنمای معاملات</span>
                  </span>
                </li>

                <li v-if="show.meter || show.area">
                  <span>متراژ</span>
                  <span style="float: left;">@{{ show.area }} متر</span>
                </li>

                <li v-if="show.car_price || show.deposite || show.rent || show.price">
                  <span>قیمت</span>
                  <span style="float: left;">
                    <span v-if="show.car_price">@{{ show.car_price }} افغانی</span>
                    <span v-else-if="show.deposite || show.rent">
                      <span v-if="show.deposite">گروی: @{{ show.deposite }} - </span>
                      <span v-if="show.rent">کرایه: @{{ show.rent }} افغانی</span>
                    </span>
                    <span v-else-if="show.price">@{{ show.price }} افغانی</span>
                  </span>
                </li>

                <li v-if="show.number">
                  <span>تعداد اتاق</span>
                  <span style="float: left;">@{{ show.number }}</span>
                </li>

                <li v-if="show.brand">
                  <span>برند</span>
                  <span style="float: left;">@{{ show.brand }}</span>
                </li>

                <li v-if="show.run_time">
                  <span>کارکرد</span>
                  <span style="float: left;">@{{ show.run_time }} کیلومتر</span>
                </li>

                <li v-if="show.year">
                  <span>سال ساخت</span>
                  <span style="float: left;">@{{ show.year }}</span>
                </li>

                <li v-if="show.relative_time">
                  <span>زمان این تبلیغات</span>
                  <span style="float: left;">@{{ show.relative_time }}</span>
                </li>

                <li v-if="show.mobile">
                  <span>شماره تماس</span>
                  <span style="float: left;">@{{ show.mobile }}</span>
                </li>

                <li v-if="show.email">
                  <span>ایمیل</span>
                  <span style="float: left;">@{{ show.email }}</span>
                </li>

                <li v-if="show.maker">
                  <span>سازنده</span>
                  <span style="float: left;">@{{ show.maker }}</span>
                </li>

                <li style="border: none;" v-if="show.text">
                  <span>توضیحات</span>
                  <span style="float: left;">@{{ show.text }}</span>
                </li>
              </ul>
            </div>

            <div class="show_image col-lg-4">
                  <div id="carouselAdvert" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div
                        class="carousel-item"
                        :class="{ active: index === 0 }"
                        v-for="(img, index) in show.images"
                        :key="index"
                        >
                        <img :src="'/uploads/' + img" class="d-block w-100" style="object-fit: cover;" alt="عکس">
                      </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAdvert" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">قبلی</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselAdvert" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">بعدی</span>
                    </button>
                  </div>
          </div>



          <!-- modal -->


        <div class="modal fade" :id="'chatemodal'+show.Id" tabindex="-1" aria-hidden="true" style="direction: rtl;">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content profile-modal">
              
            
              <div class="content_showchat_modal" style="width: 500px;height: 350px;">
             
             <form :action="'/sendmessage/'+show.u_id" method="post">
              @csrf
                <span> ارسال پیام</span> 
                 
              @if (empty(Session::get('verified_mobile')))



              @else

                <input type="text" name="sender_id" :value="{{ auth()->user()->u_id }}"> 

              @endif

                  <textarea name="chat_text" placeholder="پیام خود را بنویسید..." id="" ></textarea>
          
                  <input type="text" :value ="show.Id" name="advert_id">


                    <input type="submit" name="" value="ارسال" class="btn btn-danger button_message"> 
                  
               </form>

              </div>
        
             
            </div>
          </div>
        </div>

      </div>

  

</section>







@endsection
