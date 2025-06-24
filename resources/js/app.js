// ابتدا jQuery را وارد کرده و به window اضافه کن
import $ from 'jquery';
window.$ = window.jQuery = $;

// سپس bootstrap را بعد از jQuery لود کن
import 'bootstrap';

import Swal from 'sweetalert2';

// سپس Vue را ایمپورت کن
import Vue from 'vue/dist/vue.js';
import axios from 'axios';
import { compileString } from 'sass';
import { create } from 'lodash';

// حالا Vue app را بساز
const app = new Vue({
    el: '#app',
    data: {
        NameCategory: "",
        parent_id:0,
        p_id:"",
        categorys:[],
        advertcat:[],
        showSecondUl: false,
        showThirdUl: false,
        submenus:[],
        menu:[],
        submenuSelectedId: null,
        submenuSelectedName: '',
    },

      mounted(){

             this.gedcategory();
      },

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
              send_advert2: function(){
                   
              },

        /********subcat********/

          Sendsubmenu:function(id){
                const selected = this.submenus.find(s => s.id === id);
                    if (selected) {
                        this.submenuSelectedId = id;
                        this.submenuSelectedName = selected.name;
                    }
                axios.post('/subcats',{
                id: id

                }).then(Response=>{
                    this.menu=Response.data;
                     $('.send-advert1').hide();
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
