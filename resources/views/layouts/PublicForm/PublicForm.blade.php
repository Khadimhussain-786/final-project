
         <div class="col-lg-12" style="float: right;">
                              <div class="col-lg-6" style="float: right;">
                                <div class="form-group">
                                  <label for="">شهر</label>
                                  <select id="" class="form-control" v-model="city" name="city">
                                      <option value="">انتخاب کنید</option>
                                      <option value="کابل">کابل</option>
                                      <option value="هرات">هرات</option>
                                      <option value="قندهار">قندهار</option>
                                      <option value="بلخ">بلخ</option>
                                      <option value="ننگرهار">ننگرهار</option>
                                      <option value="کندز">کندز</option>
                                      <option value="تخار">تخار</option>
                                      <option value="بدخشان">بدخشان</option>
                                      <option value="پروان">پروان</option>
                                      <option value="کاپیسا">کاپیسا</option>
                                      <option value="لوگر">لوگر</option>
                                      <option value="وردک">وردک</option>
                                      <option value="پکتیا">پکتیا</option>
                                      <option value="پکتیکا">پکتیکا</option>
                                      <option value="خوست">خوست</option>
                                      <option value="لغمان">لغمان</option>
                                      <option value="نورستان">نورستان</option>
                                      <option value="کنر">کنر</option>
                                      <option value="بامیان">بامیان</option>
                                      <option value="دایکندی">دایکندی</option>
                                      <option value="غور">غور</option>
                                      <option value="فراه">فراه</option>
                                      <option value="نیمروز">نیمروز</option>
                                      <option value="هلمند">هلمند</option>
                                      <option value="زابل">زابل</option>
                                      <option value="ارزگان">ارزگان</option>
                                      <option value="سرپل">سرپل</option>
                                      <option value="سمنگان">سمنگان</option>
                                      <option value="جوزجان">جوزجان</option>
                                      <option value="فاریاب">فاریاب</option>
                                      <option value="بغلان">بغلان</option>
                                      <option value="غزنی">غزنی</option>
                                      <option value="پنجشیر">پنجشیر</option>
                                  </select>
                                </div>
                              </div>
                              
                              <input type="text" style="position:absolute;display:none;" v-bind:value="category.id" name="category_id" id="category">
                                 
                              <div class="col-lg-10" style="float: right;">
                                <div class="form-group">
                                      <label for="">نقشه</label>
                                      
                                </div>
                              </div>

                              <div class="col-lg-4" style="float: right;">
                                <div class="form-group">
                                      <label for="">در اطراف شهر</label>
                                      <input class="form-check-input" type="checkbox">                                      
                                </div>
                              </div>
                            

                              <div class="col-lg-12" style="float: right;">
                                <div class="form-group">
                                      <label for="">تصاویر</label>

                                      <form action="/addimage" method="post" class="dropzone" id="myDropzone" >
                                      @csrf
                                      </form>
                                </div>
                              </div>
   
                             <div class="col-lg-12" style="float: right;">
                                <div class="form-group">
                                    <label for="">سازنده</label>
                                      <div class="col-lg-12" style="float: right;">
                                          <div class="form-group">
                                              <label for="">سازنده</label>
                                              <input type="text" name="maker" v-model="maker" class="form-control" placeholder="نام سازنده را وارد کنید">
                                          </div>
                                      </div>
                                </div>
                                </div>

                                <div class="col-lg-4" style="float: right;margin-top: 22px;">
                                <div class="form-group">
                                  <label for="">قیمت(افغانی)</label>
                                    <select name="price" class="form-control" v-model="selectedPriceOption">
                                      <option value="0">قیمت مورد نظر</option>
                                      <option value="1">مجانی</option>
                                      <option value="2">توافقی (تماس بگیرید)</option>
                                    </select>                          
                                </div>
                              </div>

                               <div class="col-lg-8" style="float: left;margin-top: 49px;">
                                <div class="form-group">
                                   <input type="text" class="form-control" v-model="price" name="fee" :disabled="selectedPriceOption != 0">
                                </div>
                              </div>

                                 <div class="col-lg-12" style="float: right;">
                                <div class="form-group">

                                      <label for="">نوع</label>
                                                                       
                                </div>
                              </div>

                               <div class="col-lg-2" style="float: right;">
                                <div class="form-group">
                                  <input class="form-check-input" type="radio" value="0" v-model="adType" name="type">
                                       فروشی
                                                                    
                                </div>
                              </div>

                               <div class="col-lg-2" style="float: right;">
                                <div class="form-group">
                                  <input class="form-check-input" type="radio" value="1" v-model="adType"  name="type">
                                      درخواستی
                                                                                                
                                </div>
                              </div>

                               <div class="col-lg-12" style="float: left;margin-top: 28px;">
                                <div class="form-group">
                                     <label for="">شماره موبایل</label>
                                    <input type="text" class="form-control" v-model="phone" name="mobile" placeholder="شماره موبایل شما(*********0093)">
                                    <span style="color: #9a9090 ;">کد تایید به شماره شما ارسال خواهد شد. تماس و چت نیز با این شماره انجام میشود</span>
                                </div>
                              </div>

                                <div class="col-lg-6" style="float: right;">
                                <div class="form-group">
                                    <input class="form-check-input" :value="1" v-model="chatEnabled" name="chat" type="checkbox">  
                                        چت برنامه فعال شود                                         
                                </div>
                              </div>

                               <div class="col-lg-12" style="float: left;margin-top: 28px;">
                                <div class="form-group">
                                     <label for="">ایمیل </label>
                                    <input type="text" name="email" v-model="email" class="form-control" placeholder="******@gmail.com">
                                    <span style="color: #9a9090 ;">آدرس ایمیل خود را به درستی وارید کنید. لینک "مدریت آگهی" به ایمیل تان ارسال میشه</span>
                                </div>
                              </div>

                                <div class="col-lg-6" style="float: right;">
                                <div class="form-group">
                                    <input class="form-check-input" name="noemail" :value="1" v-model="emailVisible" type="checkbox">  
                                        ایمیل در آگهی نمایش داده شود                                         
                                </div>
                              </div>

                                <div class="col-lg-12" style="float: left;margin-top: 28px;">
                                <div class="form-group">
                                     <label for="">عنوان آگهی </label>
                                    <input type="text" v-model="title" class="form-control" name="subject" >
                                    <span style="color: #9a9090 ;">از عنوان های مفید و کوتاه استفاده کنید. اشاره به محل ملک و متراج باعث دیده شدن بشتر آکهی میشود</span>
                                </div>
                              </div>
                              
                                <div class="col-lg-12" style="float: left;margin-top: 28px;">
                                <div class="form-group">
                                     <label for="">توضیحات آگهی</label>
                                    <textarea class="form-control" v-model="description" name="text" id=""></textarea>
                                    <span style="color: #9a9090 ;">جزایات کامل در باره آگهی خود بنوسید. شانس موفقیت آگهی تان را بالا میبرد </span>
                                </div>
                              </div>

                             <div class="col-lg-12" style="margin-bottom: 20px;" >
                                <div class="form-group" style="float:left;">
                                      <form action="/addimage" method="post">
                                                 @csrf
                                            <button type="button" class="btn btn-danger" @click="addpublic()" style="font-size: 13px;padding: 12px 40px;">
                                                ارسال رایگان آگهی
                                            </button>
                                      </form>
                                  </div>
                              </div>

                             

                         </div>
                     </div>
   
   
            
                          