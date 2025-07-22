<template>

            <div class="custom-panel-body">

               
                <div class="form-group">
                    <label for="fname">نام:</label>
                    <input type="text" name="fname" placeholder="نام تان را وارید کنید" v-model="user_name"> 
                </div>
                <div class="form-group">
                    <label for="email">ایمیل:</label>
                    <input type="text" name="email" placeholder="ایمیل تان را وارید کنید" v-model="user_email"> 
                </div>
                <div class="form-group">
                    <label for="number">شماره:</label>
                    <input type="text" name="number" placeholder="شماره تان را وارید کنید" v-model="user_mobile"> 
                </div>
                <div class="form-group">
                    <label for="password">رمز عبور :</label>
                    <input type="password" name="password" placeholder=" رمز تان را وارید کنید" v-model="user_password"> 
                </div>

                <div class="form-groug">
                    <label for="password">سطح دست رسی :</label>
                    <select name=""  v-model="role" class="form-control">
                        <option value="مدیرکل">مدیرکل</option>
                        <option value="ناظر">ناظر</option>
                    </select>
                </div>
                 
                 <button type="button" class="btn btn-success" @click="adduser()">ایجاد کاربر</button>

            </div>
     

</template>

<script>

import axios from 'axios';

export default {
     data(){
        return{
         user_name:'',   
         user_email:'',   
         user_mobile:'',
         user_password:'',
         role:'',


        }
     },

     methods:{

        adduser:function(){

            axios.post('/admin/adduser', {
                name:this.user_name,
                email:this.user_email,
                mobile:this.user_mobile,
                password:this.user_password,
                role:this.role
            }).then(Response => {
                console.log(Response);
            }, Response => {
            });
        }

     }

     
};
</script>

<style scoped>

</style>
