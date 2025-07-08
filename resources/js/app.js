import $, { error } from 'jquery';
window.$ = window.jQuery = $;


import 'bootstrap';

import Swal from 'sweetalert2';


import Vue from 'vue/dist/vue.js';
import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


import { compileString } from 'sass';
import { create } from 'lodash';

/******** Dropzone *******/
import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";

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

        brand: "",
        year: "",
        run_time: "",
        price: "0",

        /*****addpublic*****/
        maker: "",
        /***satatuscode***/
        code:"",

    },

    mounted() {
        this.gedcategory();


        // this.$nextTick(() => {

        // Dropzone.autoDiscover = false;
        // const dropzoneElement1 = document.getElementById("myDropzone1");
        // if (dropzoneElement1 && !dropzoneElement1.dropzone) {
        //     new Dropzone(dropzoneElement1, {
        //         url: "/editimage",
        //         maxFiles: 5,
        //         acceptedFiles: "image/*",
        //         dictDefaultMessage: "تصاویر را اینجا بکشید یا کلیک کنید",
        //         init() {
        //             this.on("success", (file, response) => {
        //                 app.images.push(response); // یا app.carImages اگر می‌خواهید جدا ذخیره شوند
        //             });
        //         }
        //     });
        // }
        // });
        
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
            }
            }
,

    methods:{

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
                this.submenuSelected = this.submenus.find(item => item.id === id);
            }
            axios.post('/subcats', {
                id: id
            }).then(Response => {
                this.menu = Response.data;
                $('.send-advert1').hide();
                $('.send-advert3').hide();
            }, Response => {
                // handle error
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
