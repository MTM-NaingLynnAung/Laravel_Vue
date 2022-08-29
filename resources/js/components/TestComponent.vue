<template>
    <div class="col-3 m-auto mt-5">
      <div class="alert alert-danger" v-if="message">{{ message }}</div>
      <form @submit.prevent="login">
        <h1>Login</h1>
        <div class="form-group">
          <label for="">Email</label>
          <input type="email" class="form-control" v-model="email">
        </div>
         <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" v-model="password">
        </div>
        <button class="btn btn-primary mt-3" type="submit">Login</button>
      </form>
    </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: '',
      message: ''
    }
  },
  methods: {
    login(){
      if(this.email === 'admin@admin.com' && this.password === 'password'){
        localStorage.setItem('auth', this.email);
        this.$router.push('/vue/posts')
      }else {
        this.message = "Email or Password is invalid"
      }
    }
  }

}
</script>

<style>

</style>
