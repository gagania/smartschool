<template>
  <div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input
        type="email"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        v-model="user.email"
      />
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" v-model="user.password"  id="exampleInputPassword1" />
    </div>
    <button type="submit" @click="login" class="btn btn-primary">Submit</button>
  </div>
</template>

<script>
export default {
    data: () => ({
      user : {
        email: "",
        password: ""
      }
    }),
    methods: {
      login() {
        this.$store.dispatch('currentUser/loginUser', this.user)
      }
    }
}
</script>