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
        password: ''
      }
    }
  },
  methods: {
    login(){
      axios.post('/api/login', this.user)
      .then(response => {
        this.$router.push({name: 'UserIndex'})
      })
    }
  }
}
</script>

<style>

</style>
