
import $ from 'jquery';
window.$ = window.jQuery = $;


import 'bootstrap';

import Swal from 'sweetalert2';


import Vue from 'vue/dist/vue.js';
import axios from 'axios';
import { compileString } from 'sass';
import { create } from 'lodash';

/********dropzon*******/

import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";

Dropzone.autoDiscover = false;

const app = new Vue({
    el: '#app',
    data: {
        NameCategory: "",
        parent_id:0,
        p_id:"",
        categorys:[],
        advertcat:[],
        showSecondUl: false,
        // showThirdUl: false,
        showSendAdvert3: false,
        submenus:[],
        menu:[],
        submenuSelectedId: null,
        submenuSelectedName: '',
        category:"",
        submenuSelected: {},
    },

      mounted() {
    this.gedcategory();
    },

    watch: {
    showSendAdvert3(newVal) {
        if (newVal) {
            this.$nextTick(() => {
                Dropzone.autoDiscover = false;

                const dropzoneElement = document.getElementById("my-dropzone");

                if (dropzoneElement && !dropzoneElement.dropzone) {
                    new Dropzone(dropzoneElement, {
                        url: "/upload", // اگر backend داری
                        maxFiles: 5,
                                acceptedFiles: "image/*",
                                dictDefaultMessage: "فایل‌ها را اینجا بکشید یا کلیک کنید",
                                init: function () {
                                    this.on("success", function (file, response) {
                                        console.log("فایل آپلود شد", response);
                                    });
                                }
                            });
                        }
                    });
                }
            }
        }
        ,


    methods: {

        //  addCategory() {
        //      axios.post('/addcategory',{
        //          Namecategory:this.Namecategory
        //      }).then(Response=>{
               
        //          alert('ok')
        //      },Response=>{
        //          this.error=1;
        //          console.log('error');
          
        //      })
        //  },



       /*********send_advert2********/
              send_advert2: function(id){

                   axios.post('/send_advert2',{
                id: id

                }).then(Response=>{
                    this.category=Response.data;
                     $('.send-advert1').hide();
                     $('.send-advert2').hide();
                     $('#card').hide();
                     $('.send-advert3').show();
                     this.showSendAdvert3=true;
                    // this.showSecondUl = true;
                },Response=>{
                   
                })
              },

        /********subcat********/

          Sendsubmenu:function(id){
                const selected = this.submenus.find(s => s.id === id);
                    if (selected) {
                        this.submenuSelectedId = id;
                        this.submenuSelectedName = selected.name;
                        this.submenuSelected = id;
                          this.submenuSelected = this.submenus.find(item => item.id === id);
                    }
                axios.post('/subcats',{
                id: id

                }).then(Response=>{
                    this.menu=Response.data;
                     $('.send-advert1').hide();
                      $('.send-advert3').hide();
                    // this.showSecondUl = true;
                },Response=>{
                   
                })

                /*******catmenus*******/ 

          },
            
        /****SendAvert****/

        SendAvert:function(id){
             axios.post('/parent',{

                id: id

            }).then(Response=>{
                 this.advertcat=Response.data;
                 $('.send-advert').hide();
                 $('.send-advert3').hide();
                 this.showSecondUl = true;
            },Response=>{
  
            })

             axios.post('/Sendsubmenu',{

                id: id

            }).then(Response=>{
                 this.submenus=Response.data; 
                 $('.send-advert').hide();
                 this.showSecondUl = true;
            },Response=>{
  
            })
        },


        
    // SendAvert: function(id) {
    //     axios.post('/parent', {
    //         id: id
    //     }).then(Response => {
    //         this.advertcat = Response.data;
    //         this.showSecondUl = true;
    //         this.showThirdUl = false;
    //     });

    //     axios.post('/Sendsubmenu', {
    //         id: id
    //     }).then(Response => {
    //         this.submenus = Response.data;
    //     });
    // },

    // Sendsubmenu: function(id) {
    //     axios.post('/subcat', {
    //         id: id
    //     }).then(Response => {
    //         this.menu = Response.data;
    //         this.showThirdUl = true;
    //     });
    // },

           gedcategory:function(){
            axios.get('/getcatagory').then(Response=>{

               this.categorys=Response.data;
               console.log(this.categorys);

            },Response=>{
               setTimeout(this.gedcategory,1000);
            })
        },

        addCategory:function(){
            axios.post('/addcategory',{

                name:this.NameCategory,
                parent_id:this.parent_id,

            }).then(Response=>{
                // alert('دسته مورد نظر باموقفیت ذخیره شد');
                            Swal.fire({
                                icon: "success",
                                title: "دسته مورد نظر باموقفیت ذخیره شد",
                                showConfirmButton: false,
                                timer: 2000
                            });
                 this.gedcategory(); // 
                 this.NameCategory = ""; 
                 this.parent_id = 0; 
            },Response=>{

            })
        },

         deleteCategory:function(){
            axios.post('/removecategory',{

                id:this.p_id,

            }).then(Response=>{

                // alert('دسته مورد نظر باموقفیت حذف شد');
                   Swal.fire({
                                icon: "success",
                                title: "دسته مورد نظر باموقفیت حذف شد",
                                showConfirmButton: false,
                                timer: 2000
                            });
                this.gedcategory(); 
                // location.href='/admin/category';
            },Response=>{

            })
        }
    }

});
