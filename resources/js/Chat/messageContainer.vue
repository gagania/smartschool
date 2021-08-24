<template>
    <div style="width:100%">
        <div style="height:400px;">
            <div v-for="(message,index) in messages" :key="index">
                <message-item :message="message"></message-item>
            </div>
        </div>
    </div>
</template>

<script>
import messageItem from './messageItem.vue'
export default {
  components: { messageItem },
    props :['messages']
}
</script>