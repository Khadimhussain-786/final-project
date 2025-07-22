<header>
        <div class="send">
            <a href="/advert">
                <button type="button" class="btn btn-danger">ارسال رایگان تبلیغات</button>
            </a>
        </div>

       <div class="link">
          <a href="#" data-bs-toggle="modal" data-bs-target="#addmobile">من</a>
          <a href="#">چت</a>
          <a href="#">درباره ما</a>
          <a href="#">بلاک</a>
          <a href="#">پشتیبانی وقوانین</a>
          <a href="#">تماس باما</a>
       </div>
       <div class="selectorCity">
               
               <a href="javascript:;" class="btn-default" data-bs-toggle="modal" data-bs-target="#exampleModal">انتخاب شهر</a>
               <i class="fa fa-angle-down"></i>
        
       </div>
       <div class="logo">
           <img src="/img/onnx.svg" alt="" >
       </div>

            <!-- Modal -->
            <div class="modal fade" id="addmobile" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="border-radius: 16px; font-size: 1.1rem;">
                    
                    <div class="modal-header border-0">
                        <h4 class="modal-title w-100 text-center fw-bold" id="loginModalLabel">ورود به حساب کاربری</h4>
                        <button type="button" class="btn-close position-absolute start-0 ms-3 mt-3" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>

                    <div class="modal-body text-center px-4">
                        
                    <!-- 1 -->
                        <div id="step1">
                        <p class="mb-3" style="font-size: 1.2rem;">شمارهٔ موبایل خود را وارد کنید</p>
                        <p class="text-muted mb-4">برای استفاده از امکانات، لطفاً شماره موبایل خود را وارد کنید. کد تأیید به این شماره ارسال خواهد شد.</p>

                        <div class="input-group mt-3 mb-3" dir="ltr" style="max-width: 400px; margin: 0 auto;">
                            <span class="input-group-text">+93</span>
                            <input type="text" id="mobile" v-model="mobilelogin" class="form-control text-end" placeholder="شمارهٔ موبایل">
                        </div>

                        <button onclick="goToStep2()" class="btn btn-danger w-100 py-2 mt-3" style="font-size: 1.2rem;" @click = "addmobile()">تأیید</button>
                        </div>

                    <!-- 2 -->
                        <div id="step2" class="d-none">
                        <p class="mb-3" style="font-size: 1.2rem;">کد تأیید را وارد کنید</p>
                        <p class="text-muted">کد پیامک‌شده به شماره <span id="showMobile"></span> را وارد کنید.</p>

                        <div class="input-group mt-3 mb-3" dir="ltr" style="max-width: 400px; margin: 0 auto;">
                            <input type="text" class="form-control text-center" v-model="logincod" placeholder="کد تأیید ۶ رقمی">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3" style="max-width: 400px; margin: 0 auto;">
                            <button onclick="backToStep1()" class="btn btn-light btn-sm">تغییر شماره موبایل</button>
                            <span class="text-muted small">درخواست مجدد کد</span>
                        </div>

                        <button class="btn btn-danger w-100 py-2" style="font-size: 1.2rem;" @click= "checkCode()" >ورود</button>
                        </div>

                    </div>
                    </div>
                </div>
            </div>




       
</header>