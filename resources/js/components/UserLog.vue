<template>




<div>
            <div class="col-lg-4" style="float: right; padding-left:0; margin: left 0;">
                <div class="chat_user">
                    <div class="header_user">
                    <i class="fa fa-cog" data-bs-toggle="modal" data-bs-target="#chatemodal" ></i>
                    <h4>چت برنامه</h4>
                    </div>

                      <ul class="show_users">
                        <li  v-for="adverts in advert_chat" v-if="adverts.user_id == user_id " @click="chat(adverts.advert_id, adverts.user_id)" >


                         <p>{{user_id}}</p>
                        

                        <span v-if="adverts.user_id == user_id">
                          <input type="hidden" id="receiver_id" :value="adverts.receiver_id">
                        </span>
                        <span v-else>
                          <input type="hidden" id="user_id" :value="adverts.user_id">
                        </span>
                        <!--  -->

                          <input type="hidden" :value="adverts.user_id">

                          <span class="chat-image" v-if="adverts.image">
                            <img :src="'/uploads/'+adverts.image " alt="">
                          </span>
                          <span class="chat-image" v-else>
                            <img src="/uploads/no-image.jpg " alt="">
                          </span>

                          <span class="chat-title">{{ adverts.subject }}</span>
                          <span class="chat-text">{{ adverts.chat_text }}</span>
                        </li>
                      </ul>



                </div>
            </div>
            <div class="col-lg-8" style=" padding-right:0; margin: right 0;">

                <div class="chat_text">
                    <div class="header_text">
                        <h4>عنوان</h4>
                        <h6>متوسط زمان پاسخگویی بیین 1 تا 2 روز</h6>
                        <ul>
                            <li><i class="fa fa-ellipsis-v"></i></li>
                            <li style="margin-left: 30px;"><i class="fa fa-phone"></i></li>
                        </ul>

                    </div>

                    <div id="scrollbar_meddage">

                        <div class="coversation-body-warning">
                          <ul>
                            <li>لطفا از ارسال اطلاعات محرمانه مانند رمز عبور کد تایید خود داری نماید.</li>
                            <li>درصورت مشاهده هرگونه تخلف میتوانید کاربر متخلف را مسدود نمایید.</li>
                          </ul>
                        </div>


                        <div id="content" class="scrollbar">
                          <ul class="messages">

                            <chat-log :message="message" :user_id="user_id"></chat-log>

                          </ul>
                        </div>

                    </div>


                      <chat-composer :advert_id="advert_id" :sender_id="user_id" :receiver_id="receiver_id" @messagesent="handleNewMessage"/>


                </div>

            </div>
</div>










</template>

<script>

import axios from 'axios';


export default {
  props: ['user_id', 'advert_chat','advert_id','id','r_id'],
  data() {
    return {
      message: [],
    }
  },

       created(){
                Echo.private('privatechat.'+this.r_id)
                    .listen('MessageSent',(e)=>{
                   this.message.push(e.chat)
                    console.log(e.chat);
                })
        },

  methods: {
    chat(id, user_id , r_id) {
      this.$emit('showmessage', {
        advert_id: id,
      });



      $(".send-chat").css("display", "block");
      $(".advert_id").val(id);
      $(".user_id").val(user_id);

      var user_id = $('#user_id').val();
      var receiver_id = $('#receiver_id').val();

      if(user_id){
        $(".receiver_id").val(user_id);
        axios.get('/private-messages/' + user_id).then(Response => {
            this.message = Response.data
            console.log(Response.data);
          });
      }

      if(receiver_id){
        $(".receiver_id").val(receiver_id);
        axios.get('/private-messages/' + receiver_id).then(Response => {
            this.message = Response.data
            console.log(Response.data);
          });
        
      }


  
    }
  }
}
</script>
