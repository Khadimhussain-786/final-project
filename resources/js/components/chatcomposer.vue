<template>
  <div class="send_chat">
    <i class="fa fa-paperclip"></i>

    <input
      type="text"
      class="wright_massage"
      placeholder="پیام خود را بنویسید..."
      v-model="message"
      @keyup.enter="sendmessage"
    >

    <i class="fa fa-paper-plane" @click="sendmessage"></i>
  </div>
</template>

<script>
export default {
  props: {
    advert_id: Number,
    sender_id: Number,
    receiver_id: Number,
  },
  data() {
    return {
      message: ''
    }
  },
  methods: {
    sendmessage() {
      if (this.message.trim() === '') return;

      // Emit for parent if needed
      this.$emit('messagesent', {
        message: this.message,
        advert_id: this.advert_id,
        sender_id: this.sender_id,
      });

      axios.post(`/private-messages/${this.receiver_id}`, {
        advert_id: this.advert_id,
        sender_id: this.sender_id,
        chat_text: this.message
      }).then(response => {
        this.message = '';
      }).catch(error => {
        console.error('خطا در ارسال پیام:', error);
      });
    }
  }
}
</script>

<style scoped>
/* استایل تغییری نمی‌خواهد */
</style>
