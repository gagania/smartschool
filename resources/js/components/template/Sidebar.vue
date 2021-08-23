<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      </div>

      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link to="/student" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Student
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <li class="nav-item">
              <router-link to="/teacher" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Teacher</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/chat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Chat</p>
              </router-link>
            </li>
            <li class="nav-item">
              <a href="#" @click="logout" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
export default {
  data: () => ({
    user: {
      email: "",
      password: "",
    },
  }),
  methods: {
    logout() {
      this.$store.dispatch("currentUser/logoutUser");

    },
  },
  
};
</script>