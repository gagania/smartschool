<template>
    <div class="relative h-10 m-1">
        <div style="border-top:1px solid #e6e6e6" class ="grid grid-cols-6">
            <input type="text"
                v-model="message"
                @keyup.enter="sendMessage()"
                placeholder="Say Something...."
                class="col-md-11 outline-none p-1"
            />
            <button @click="sendMessage()" 
                class="place-self-end bg-gray-500 
                hover:bg-blue-700 p-1 mt-1 rounded">
                Send
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props:['room'],
    data : function() {
        return {
            message:""
        }
    },
    methods: {
        sendMessage() {
            if(this.message == '') {
                return;
            }

            axios.post('/api/chat/room/'+this.room.id+'/message',{
                user :localStorage.getItem('user_id'),
                message:this.message
                },
                {headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}}
            )
            .then(Response=> {
                if(Response.status == 201) {
                    this.message = '';
                    this.$emit('messagesent');
                }
            })
            .catch(error=>{
                console.log(error);
            })
         }
    }
}
</script>