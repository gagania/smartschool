<template>
  <div class="userContainer">
    <div class="heading">
      <h2 class="title">Hello, world.</h2>
      <add-user-form v-on:reloadlist="getList()"/>
    </div>
    
    <list-view :users="users"
      v-on:reloadlist="getList()"
    />    
  </div>
</template>
<script>
import addUserForm from './addUserForm';
import ListView from './listView';

export default {
  components : {
    addUserForm,
    ListView
  },
  data : function () {
    return {
      users:[]
    }
  },
  methods: {
    getList() {
      axios.get('api/user')
      .then(response =>{
        this.users = response.data.data
      })
      .catch(error =>{
        console.log(error)
      })
    }
  },
  created() {
    this.getList();
  }
}
</script>

<style scoped>
  .userContainer {
    width:550px;
    margin:auto;
  }
  .heading {
    background: #e6e6e6;
    padding:10px;
  }
  #title {
    text-align: center;

  }
</style>