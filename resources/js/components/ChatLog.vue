<template>

  <div>

      <ul v-for="messages in  message"  class="media-list message">

          <li v-if="messages.user_id == user_id" class="pull_right">
            
            <span> {{ messages.chat_text }} </span>
              
          </li>

          <li v-else class="pull_left">
            
            <span> {{ messages.chat_text }} </span>
              
          </li>
          <!-- <chat-message></chat-message> -->
      </ul>

  </div>

</template>

<script>
export default {

      props:['message','user_id'],

   data(){
    return[

    ]
   }
};
</script>

<style scoped>

</style>

