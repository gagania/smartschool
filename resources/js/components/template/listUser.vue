<template>
    <div class="user">
        <input type="checkbox" 
            @change="updateCheck()"/>
        <span class="itemText">{{ user.name }}</span>
        <button @click="removeUser()" class="trashcan">
            <font-awesome-icon icon="trash"/>
        </button>
    </div>
</template>

<script>
export default {
    props : ['user'],
    methods: {
        updateCheck() {
            axios.put('api/user/'+ this.user.id, {
                user: this.user
            })
            .then(response => {
                if(response.status == 200) {
                    this.$emit('userChanged');
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        removeUser() {
            axios.delete('api/user/'+ this.user.id)
            .then (response =>{
                if (response.status == 200) {
                    this.$emit('userChanged');
                }
            })
            .catch (error =>{
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>
    .itemText {
        width:100%;
        margin-left:20px;
    }
    .user {
        display:flex;
        justify-content: center;
        align-items:center;
    }
    .trashcan {
        background: #e6e6e6;
        border:none;
        color:#FF0000;
        outline: none;
    }
</style>