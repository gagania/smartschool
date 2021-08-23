<template>
    <div class="wrapper" id="app">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <!-- Navbar -->
        <navbar></navbar>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <sidebar></sidebar>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- <list-view :users="users"
                        v-on:reloadlist="getList()"
                        />  -->
                    <!-- <content-app></content-app> -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <footer></footer>

    </div>

</template>
<script>
import Sidebar from './template/Sidebar';
import Navbar from './template/Navbar';
import Footer from './template/Footer';
import ContentApp from './template/ContentApp';
export default {
    name : "#app",
    components :{
        Sidebar,
        Navbar,
        Footer,
        ContentApp,
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