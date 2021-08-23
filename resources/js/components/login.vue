<template>
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Smart</b>School</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <div class="input-group mb-3">
          <input type="email" v-model="user.email" class="form-control" placeholder="Email" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" v-model="user.password" class="form-control" placeholder="Password" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="school_name" v-model="user.schd_name" class="form-control" placeholder="School" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group">
          <label class="">
                <div class="iradio_flat-green checked" style="position: relative;" 
                aria-checked="true" aria-disabled="false">
                    <input type="radio" name="r3" class="flat-red" /> Student
                    <input type="radio" name="r3" class="flat-red" /> Teacher
                </div>
            </label>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button
              type="submit"
              @click="login"
              class="btn btn-primary btn-block"
            >
              Sign In
            </button>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.social-auth-links -->
        <p class="mb-0">
          <router-link :to="{ name: 'register' }">Register</router-link>
          <!-- <a href="#" @click="register" class="text-center"
            >Register</a
          > -->
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  
  <!-- /.login-box -->
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
    login() {
      this.$store.dispatch("currentUser/loginUser", this.user);
    },
    register() {
      
    }
  }
};
</script>