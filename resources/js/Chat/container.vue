<template>
    <div class="card">
    <div class="card-header">
      <h3 class="card-title">
          <chat-room-selection
              v-if="currentRoom.id"
              :rooms="chatRooms"
              :currentRoom="currentRoom"
              v-on:roomChange="setRoom( $event)">
          </chat-room-selection>
      </h3>

      <div class="card-tools"></div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <message-container :messages="messages"></message-container>
        <input-message 
            :room="currentRoom"
            v-on:messagesent="getMessages()"></input-message>
    </div>
    <!-- /.card-body -->
  </div>
</template>

<script>
import inputMessage from '../Chat/inputMessage'
import ChatRoomSelection from './ChatRoomSelection'
import MessageContainer from './messageContainer'
export default {
    components: { 
        MessageContainer,
        inputMessage,
        ChatRoomSelection 
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
            axios.get('/api/chat/rooms',
            {headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}}
            )
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
            axios.get('/api/chat/room/' + this.currentRoom.id + '/messages',
            {headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}})
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