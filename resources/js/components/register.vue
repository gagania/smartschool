<template>
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Smart</b>School</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register</p>
          <div class="input-group mb-3">
            <input type="text" v-model="user.name" class="form-control" placeholder="Full name" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" v-model="user.email" 
            placeholder="Email" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
                id="password"
                name="password"
                type="password"
                class="form-control"
                v-model="user.password"
                ref="password"
                placeholder="Password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
              type="password"
              class="form-control"
              v-validate="'required|confirmed:password'"
              placeholder="Retype password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" v-model="user.schl_name" 
            placeholder="School Name" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group">
            <label class="">
                    <div class="iradio_flat-green checked" style="position: relative;" 
                    aria-checked="true" aria-disabled="false">
                        <input type="radio" name="type" value="S" v-model="user.type" class="flat-red" /> Student
                        <input type="radio" name="type" value="T" v-model="user.type" class="flat-red" /> Teacher
                        <input type="hidden" value="User" v-model="user.roles"/>
                    </div>
                </label>
            </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" @click="register" class="btn btn-primary btn-block">
                Register
              </button>
            </div>
            <!-- /.col -->
          </div>
        <router-link :to="{ name: 'login' }">I already have an Account</router-link>
      </div>
      <!-- /.form-box -->
    </div>
    <!-- /.card -->
  </div>
</template>

<script>
// import { mapState, mapActions } from 'vuex'

export default {
  data() {
    return {
      user: {
          user: {
            name: "",
            email: "",
            password: "",
            schl_name: "",
          }
      },
    };
  },
  methods: {
    register() {
      this.$store.dispatch("currentUser/registerUser", this.user);
    },
  }
};
</script>