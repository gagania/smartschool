<template>
    <div class="card">
    <div class="card-header">
      <h3 class="card-title">Chat</h3>

      <div class="card-tools"></div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <message-container></message-container>
        <input-message :room="currentRoom"></input-message>
    </div>
    <!-- /.card-body -->
  </div>
</template>

<script>
import inputMessage from '../Chat/inputMessage'
import MessageContainer from './messageContainer'
export default {
  components: { 
      MessageContainer,
        inputMessage 
    },
    data : function() {
        return {
            chatRooms: [],
            currentRoom:[],
            messages:[]
        }
    },
    methods : {
        getRooms() {
            axios.get('/api/chat/rooms')
            .then(response =>{
                
                this.chatRooms  = response.data;
                this.setRoom(response.data[0]);
            })
            .catch(error => {
                console.log(error);
            })
        },
        setRoom(room) {
            this.currentRoom = room;
            this.getMessages();
        },
        getMessages() {
            axios.get('/api/chat/room/' + this.currentRoom.id + '/messages')
            .then(response => {
                this.messages = response.data; 
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
    created() {
        this.getRooms();
    }

}
</script>MessageContainer