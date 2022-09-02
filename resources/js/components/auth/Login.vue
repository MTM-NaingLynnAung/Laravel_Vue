<template>
  <div class="container">
    <h2>Login Form</h2>
    <form @submit.prevent="login">
      <div class="col-4">
        <div class="form-group">
          <label for="">Email : </label>
          <input type="email" class="form-control" v-model="user.email">
         
        </div>
        <div class="form-group">
          <label for="">Password : </label>
          <input type="password" class="form-control" v-model="user.password">
          <div v-if="messageError">
            <p v-text="message" class="alert alert-danger"></p>
          </div>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Login</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return {
      user: {
        email : '',
        password: '',
        token: 'browser'
      },
      message: {},
      messageError: false
      // loginStatus: true
    }
  },
  methods: {
    login(){
      axios.post('/api/login', this.user)
      .then(response => {
        localStorage.setItem('userData', JSON.stringify(response.data))
        this.$router.push({name: 'UserIndex'})
        window.location.reload();
        
      })
      .catch(error => {
        this.message = error.response.data.message
        this.messageError = true
      });
      // this.$emit('login-status', {
      //   loginStatus: this.loginStatus
      // })
    }
  }
}
</script>

<style>

</style>
