import $, { error } from 'jquery';
window.$ = window.jQuery = $;


import 'bootstrap';

import Swal from 'sweetalert2';


import Vue from 'vue/dist/vue.js';
import axios from 'axios';
import InfiniteLoading from 'vue-infinite-loading';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


import { compileString } from 'sass';
import { create } from 'lodash';

/******** Dropzone *******/
import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";
Vue.component('infinite-loading', InfiniteLoading);

Vue.component('chat-component', require('./components/ChatComponenet.vue'));
Vue.component('chat-message', require('./components/chatMessageComponent.vue').default);
Vue.component('chat-composer', require('./components/chatcomposer.vue').default);
Vue.component('chat-log', require('./components/ChatLog.vue').default);
Vue.component('user-log', require('./components/UserLog.vue').default);
Vue.component('add-user', require('./components/adduser.vue').default);


Dropzone.autoDiscover = false;

const app = new Vue({
    el: '#app',
    data: {
        NameCategory: "",
        parent_id: 0,
        p_id: "",
        categorys: [],
        advertcat: [],
        showSecondUl: false,

        showSendAdvert3: false,
        submenus: [],
        menu: [],
        submenuSelectedId: null,
        submenuSelectedName: '',
        category: "",
        submenuSelected: {},

        /******** estate fields ********/
        area: "",
        city: "",
        numberRoom: "",
        fee: "",
        rent: "",
        feeType: "custom",
        rentType: "custom",
        advertiser: "",
        adType:"",
        title: "",
        description: "",
        phone: "",
        email: "",
        emailVisible: false,
        chatEnabled: false,
        aroundCity: false,
        images: [],

        /********cars fields********/
        priceType: '0', 
        brand: "",
        year: "",
        run_time: "",
        price: "0",

        /*****addpublic*****/
        maker: "",
        selectedPriceOption: "0",
        /***satatuscode***/
        code:"",

        /******show advert******/

        advert: [],
        searchQuery: '',
        userCity: '',  
        page:1,
        show:"",
        showVisible: false,
        contentVisible: true,
        asideVisible: true,
        /****login****/

        mobilelogin:'',
        logincod:'',
        /******filtering******/
        selectedCategoryId: null,
        searchQuery: '',
        userCity: '',
        selectedMainCategory: null,
         subCategories: [],

         /****chat*****/
            users: [ // نمونه ساختگی، می‌تونی با AJAX از سرور بگیری
                { id: 1, name: 'علی', avatar: '/images/avatar1.jpg' },
                { id: 2, name: 'سارا', avatar: '/images/avatar2.jpg' }
            ],
            selectedUser: {}, // کاربر انتخاب‌شده برای چت
            messages: [], // پیام‌های رد و بدل شده
            newMessage: '', // متن پیام جدید
            advert_chat: [],
    },



    mounted() {

        this.gedcategory();
        console.log('Vue is mounted');

        const pathParts = window.location.pathname.split('/');
        if (pathParts[1] === 'city' && pathParts[2]) {
            this.userCity = decodeURIComponent(pathParts[2]);
        }
        
        this.showusers();
    },

     watch: {
            showSendAdvert3(newVal) {

                if (newVal) {
                this.$nextTick(() => {
                    Dropzone.autoDiscover = false;
                    const dropzoneElement = document.getElementById("myDropzone");
                    if (dropzoneElement && !dropzoneElement.dropzone) {
                    new Dropzone(dropzoneElement, {
                        url: "/addimage",
                        maxFiles: 5,
                        acceptedFiles: "image/*",
                        dictDefaultMessage: "تصاویر را اینجا بکشید یا کلیک کنید",
                        init() {
                    this.on("success", (file, response) => {
                            app.images.push(response);
                            });
                        }
                    });
                    }
                });
                }
            },

            priceType(newVal) {
                if (newVal == '1') {
                    this.price = 0;
                } else if (newVal == '2') {
                    this.price = 1;
                }
            },
           /*******public form******/
            selectedPriceOption(newVal) {
                if (newVal === "1") {
                    this.price = "1";
                } else if (newVal === "2") {
                    this.price = "2";
                } else {
                    this.price = "";
                }
            },

            /*******estate form ******/
            feeType(val) {
                if (val === 'free') {
                this.fee = 1;
                } else if (val === 'contact') {
                this.fee = 2;
                } else {
                this.fee = ''; // آماده برای ورودی دستی
                }
            },
            rentType(val) {
                if (val === 'free') {
                this.rent = 1;
                } else if (val === 'contact') {
                this.rent = 2;
                } else {
                this.rent = ''; // آماده برای ورودی دستی
                }
            }

     },


        computed: {
                filteredAdverts() {
                    const keyword = this.searchQuery.trim();
                    const regex = new RegExp(keyword, 'i');

                    return this.advert.filter(ad => {
                        const matchesCity = ad.city === this.userCity;
                        const matchesKeyword = keyword === '' || (ad.subject && regex.test(ad.subject));

                        if (!this.selectedCategoryId) return matchesCity && matchesKeyword;

                        const adCategory = this.categorys.find(c => c.id === ad.category_id);
                        if (!adCategory) return false;

                        // آگهی متعلق به دسته یا زیر‌دسته‌ی انتخابی است؟
                        return matchesCity && matchesKeyword &&
                            (ad.category_id === this.selectedCategoryId ||
                            adCategory.parent_id === this.selectedCategoryId ||
                            this.getRootParentId(adCategory) === this.selectedCategoryId);
                    });
                }

        },





    methods:{



        /********chate*********/

        selectUser(user) {
            this.selectedUser = user;
            // در حالت واقعی: پیام‌های این کاربر را لود کن
            this.messages = [
                { id: 1, from_me: false, text: 'سلام!', time: '10:00' },
                { id: 2, from_me: true, text: 'سلام. خوبی؟', time: '10:01' }
            ];
        },
        sendMessage() {
            if (this.newMessage.trim() === '') return;

            this.messages.push({
                id: Date.now(),
                from_me: true,
                text: this.newMessage,
                time: new Date().toLocaleTimeString('fa-IR', { hour: '2-digit', minute: '2-digit' })
            });

            this.newMessage = '';
            this.scrollToBottom();
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const el = this.$refs.chatBox;
                if (el) el.scrollTop = el.scrollHeight;
            });
        },
    



       /*********catedory_filtering*******/

                selectMainCategory(category) {
                    this.selectedMainCategory = category;
                    this.selectedCategoryId = null;  // یا category.id اگر می‌خواهید دسته اصلی انتخابی را هم در selectedCategoryId نگه دارید

                    // فیلتر کردن زیر دسته‌ها
                    this.subCategories = this.categorys.filter(c => c.parent_id === category.id);
                },

                selectSubCategory(subCategory) {
                    this.selectedCategoryId = subCategory.id;
                },

                showAllAdverts() {
                    this.selectedMainCategory = null;
                    this.selectedCategoryId = null;
                    this.subCategories = [];
                },


           filterByCategory: function (categoryId) {
                this.selectedCategoryId = categoryId;
            },



        /*********manage_myapp********/

            manage_myapp:function(){

            },

        /********checkCode**********/
            checkCode: function() {
            console.log('sending mobile:', this.mobilelogin);
            console.log('sending code:', this.logincod);

            axios.post('/checkCode', {
                mobilelogin: this.mobilelogin,
                code: this.logincod
            })
            .then(response => {
                console.log(response);
                Swal.fire({
                            icon: "success",
                            title: "کد تایید شد",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        if (response.data.status === 'success') {
                            window.location.href = response.data.redirect;
                        }
            })
            .catch(error => {
                Swal.fire("خطا در بررسی کد");
                console.error(error.response.data);
            });
            },


            checkCode_chat: function() {
            console.log('sending mobile:', this.mobilelogin);
            console.log('sending code:', this.logincod);

            axios.post('/checkCode_chat', {
                mobilelogin: this.mobilelogin,
                code: this.logincod
            })
            .then(response => {
                console.log(response);
                Swal.fire({
                            icon: "success",
                            title: "کد تایید شد",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        if (response.data.status === 'success') {
                            window.location.href = response.data.redirect;
                        }
            })
            .catch(error => {
                Swal.fire("خطا در بررسی کد");
                console.error(error.response.data);
            });
            },

        /**********addmobile*********/

        addmobile:function(){
           
              axios.post('/addmobile', {
                mobilelogin: this.mobilelogin
            }).then(Response => {
                console.log(Response);
                alert("کد تایید شما: " + Response.data.code);
            }, Response => {
            });
        },

        addmobile_chat:function(){
           
              axios.post('/addmobile_chat', {
                mobilelogin: this.mobilelogin
            }).then(Response => {
                console.log(Response);
                alert("کد تایید شما: " + Response.data.code);
            }, Response => {
            });
        },



        /**********show_back1************/

            show_back1:function(){
            this.contentVisible = true;
            this.asideVisible = true;
            this.showVisible = false;
            },

        /*****************Showadverts*******************/

            Showadverts: function(id) {
            this.contentVisible = false;
            this.asideVisible = false;
            this.showVisible = true;

            axios.post('/show', { id: id }).then(Response => {
                this.show = Response.data;

                if (!Array.isArray(this.show.images)) {
                this.show.images = [];
                }

             
                this.show.images = this.show.images.filter(img => img && img.trim() !== '');

                if (this.show.images.length === 0) {
                this.show.images = ['no-image.jpg'];
                }

                console.log("Images:", this.show.images);
            }).catch(error => {
                console.error('Error loading advert:', error);
            });
            },

 


        /************end Showadverts***************/

       

         showusers: function () {
                axios.get('/showusers').then(Response => {
                  this.advert_chat = Response.data;
                console.log(this.advert)
                });
            },


          /**********show advert*************/

           infiniteHandler: function ($state) {
                axios.get('/showadvert?page=' + this.page).then(response => {
                    let data = response.data.data;

                    if (data.length) {
                        const newAds = data.map(ad => {
                            if (ad.image && typeof ad.image === 'string' && ad.image.includes('.')) {
                                ad.image = ad.image.split(',')[0];
                            } else {
                                ad.image = 'no-image.jpg';
                            }
                            return ad;
                        });
                        this.advert.push(...newAds); 
                        this.page++; 
                        $state.loaded(); 
                    } else {
                        $state.complete(); 
                    }
                }).catch(error => {
                    console.error(error);
                    $state.complete(); 
                });
            },

          /*********add all advert************/

       statuscode:function(){
         
          axios.post('/statuscode', {
                code: this.code
            }).then(Response => {
                console.log(Response);
                if(Response.data == "no"){

                     Swal.fire({
                            icon: "warning",
                            title: "!کد وارید شده اشتباه است",
                            showConfirmButton: false,
                            timer: 2500
                        })
                }else{
                 document.querySelectorAll('.warning #progress').forEach(el => el.style.backgroundColor = 'green');
                document.querySelectorAll('.wating #progress').forEach(el => el.style.backgroundColor = '#edb10a');
                document.querySelector('.manage-text').style.display = 'none';
                }
                
            }, Response => {
                // handle error
            });

       },


        addpublic: function () {
            var categorys = $("#category").val();
            axios.post('/addpublic', {
                city: this.city,
                maker: this.maker,
                price: this.price,
                adType: this.adType,
                email: this.email,
                mobile: this.phone,
                noemail: this.emailVisible,
                chat: this.chatEnabled,
                subject: this.title,
                text: this.description,
                category_id: categorys,
                images: this.images,
             }).then(response => {
                        Swal.fire({
                            icon: "success",
                            title: "آگهی با موفقیت ذخیره شد",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            if (response.data.redirect_url) {
                                window.location.href = response.data.redirect_url;
                            }
                        });
                }).catch(error => {
                    console.error(error);
                });
        },

        addcars: function () {
            var categorys = $("#category").val();
            axios.post('/addcares', {
                city: this.city,
                brand: this.brand,
                year: this.year,
                run_time: this.run_time,
                price: this.price,
                fee: this.fee,
                adType: this.adType,
                mobile: this.phone,
                email: this.email,
                noemail: this.emailVisible,
                chat: this.chatEnabled,
                subject: this.title,
                text: this.description,
                category_id: categorys,
                images: this.images,
                }).then(response => {
                        Swal.fire({
                            icon: "success",
                            title: "آگهی با موفقیت ذخیره شد",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            if (response.data.redirect_url) {
                                window.location.href = response.data.redirect_url;
                            }
                        });
                }).catch(error => {
                    console.error(error);
                });
        },

        
        
        addstate: function () {
        var categorys = $("#category").val();
            axios.post('/addstate', {
                area: this.area,
                rent: this.rentType === "custom" ? this.rent : this.rentType,
                fee: this.feeType === "custom" ? this.fee : this.feeType,
                numberRoom: this.numberRoom,
                advertiser: this.advertiser,
                city: this.city,
                adType: this.adType,
                title: this.title,
                phone: this.phone,
                email: this.email,
                description: this.description,
                emailVisible: this.emailVisible,
                chatEnabled: this.chatEnabled,
                images: this.images,
                catagory:categorys,
            }).then(response => {
                Swal.fire({
                    icon: "success",
                    title: "آگهی با موفقیت ذخیره شد",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    if (response.data.redirect_url) {
                        window.location.href = response.data.redirect_url;
                    }
                });
            }).catch(error => {
                console.error(error);
            });
        },

        handleFeeChange() {
            if (this.feeType !== "custom") {
                this.fee = "";
            }
        },

        handleRentChange() {
            if (this.rentType !== "custom") {
                this.rent = "";
            }
        },

        send_advert2: function (id) {
            axios.post('/send_advert2', {
                id: id
            }).then(Response => {
                this.category = Response.data;
                $('.send-advert1').hide();
                $('.send-advert2').hide();
                $('#card').hide();
                $('.send-advert3').show();
                this.showSendAdvert3 = true;
            }, Response => {
                // handle error
            });
        },

        Sendsubmenu: function (id) {
            const selected = this.submenus.find(s => s.id === id);
            if (selected) {
                this.submenuSelectedId = id;
                this.submenuSelectedName = selected.name;
                this.submenuSelected = selected;
            }

            axios.post('/subcats', {
                id: id
            }).then(Response => {
                this.menu = Response.data;
                $('.send-advert1').hide();
                $('.send-advert3').hide();

                if (this.menu.length === 0) {
                    // اگر زیرزیر دسته وجود ندارد، مستقیم فرم را نشان بده
                    this.send_advert2(id);
                }

            }).catch(error => {
                console.error(error);
            });
        },


        SendAvert: function (id) {
            axios.post('/parent', {
                id: id
            }).then(Response => {
                this.advertcat = Response.data;
                $('.send-advert').hide();
                $('.send-advert3').hide();
                this.showSecondUl = true;
            }, Response => {
                // handle error
            });

            axios.post('/Sendsubmenu', {
                id: id
            }).then(Response => {
                this.submenus = Response.data;
                $('.send-advert').hide();
                this.showSecondUl = true;
            }, Response => {
                // handle error
            });
        },

        gedcategory: function () {
            axios.get('/getcatagory').then(Response => {
                this.categorys = Response.data;
                console.log(this.categorys);
            }, Response => {
                setTimeout(this.gedcategory, 1000);
            });
        },


            isInEstateCategory(category) {
                return category.id === 1 || category.parent_id === 1 || this.getRootParentId(category) === 1;
            },

            isInCarCategory(category) {
                return category.id === 2 || category.parent_id === 2 || this.getRootParentId(category) === 2;
            },

            getRootParentId(category) {
                let current = category;
                while (current && current.parent_id !== 0) {
                    current = this.categorys.find(cat => cat.id === current.parent_id);
                }
                return current ? current.id : null;
            },
   



        addCategory: function () {
            axios.post('/addcategory', {
                name: this.NameCategory,
                parent_id: this.parent_id,
            }).then(Response => {
                Swal.fire({
                    icon: "success",
                    title: "دسته مورد نظر باموفقیت ذخیره شد",
                    showConfirmButton: false,
                    timer: 2000
                });
                this.gedcategory();
                this.NameCategory = "";
                this.parent_id = 0;
            }, Response => {
                // handle error
            });
        },

        deleteCategory: function () {
            axios.post('/removecategory', {
                id: this.p_id,
            }).then(Response => {
                Swal.fire({
                    icon: "success",
                    title: "دسته مورد نظر باموفقیت حذف شد",
                    showConfirmButton: false,
                    timer: 2000
                });
                this.gedcategory();
            }, Response => {
                // handle error
            });
        }
    }

});
