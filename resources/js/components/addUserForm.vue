<template>
    <div class="addUser">
    <div class="inputdiv">
        Name <input type="text" v-model="user.name"/>
    </div>
    <div class="inputdiv">
        Password <input type="text" v-model="user.password"/>
    </div>
    <div class="inputdiv">
        email <input type="text" v-model="user.email"/>
    </div>
    <div class="inputdiv">
        Roles <input type="text" v-model="user.roles"/>
    </div>
    <font-awesome-icon 
        icon="plus-square"
        @click="addUser()"
        :class="[ user.name ? 'active' : 'inactive','plus']"
    />
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            user : {
                name :"",
                password:""
            }
        } 
    },
    methods: {
        addUser() {
            if (this.user.name == '') {
                return;
            }

            axios.post('api/user/store',{
                user :this.user
            })
            .then (response =>{
                if (response.status == 201) {
                    this.user.name = '';
                    this.user.password = '';
                    this.$emit('reloadlist')
                }
            })
            .catch(error => {
                console.log( error );
            })
        }
    }
}
</script>

<style scoped>
    .addUser {
        /* display: flex; */
        justify-content: center;
        align-items: center;
    }
    .inputdiv {
        width:100%;
    }
    input {
        background: #f7f7f7;
        border:0px;
        float:left;
        /* outline: none;
        padding:5px;
        margin-right: 10px; */
        width:100%;
    }
    .plus {
        font-size: 20px;
    }
    .active {
        color : #00CE25;
    }
    .inactive {
        color:#999999;
    }
</style>    