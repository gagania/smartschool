<template>
    <div>
        <div v-for="(user,index) in users" :key="index">
            <list-user
                :user="user"
                :class="user"
                v-on:userChanged="$emit('reloadlist')"/> 
        </div>
    </div>
</template>

<script>
import listUser from "./template/listUser"
export default {
  components: { listUser },
    props: ['users'],
    components : {
        listUser
    }
}
</script>
<style scoped>
    .user {
        background: #e6e6e6;
        padding:5px;
        margin-top:5px;
    }
</style>