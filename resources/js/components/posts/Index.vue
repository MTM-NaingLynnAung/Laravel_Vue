<template>
  <div class="container">
    <h2>Post List</h2>
    <router-link :to="{ name: 'PostCreate' }" class="btn btn-sm btn-primary">Add Post</router-link>
    <div class="float-end col-3" @keyup="searchPost">
      <input type="search" class="form-control search" v-model="search">
    </div>
    <table class="table mt-5">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
      <tr v-for="post in posts" :key="post.id">
        <td>{{ post.id }}</td>
        <td>{{ post.title }}</td>
        <td>{{ post.description }}</td>
        <td>
          <img :src="post.image" alt="" width="70" height="70">
        </td>
        <td>
          <router-link :to="'/posts/edit/'+post.id" class="btn btn-sm btn-secondary text-dark">Edit</router-link>
          <button class="btn btn-sm btn-danger text-dark ms-1" @click="destroy(post.id)">Delete</button>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  data(){
    return {
      posts: [],
      search: '',
      post: {
        id: '',
        title: '',
        description: '',
        image: ''
      },
      errorMessage: false
    }
  },
  created(){
    this.getPost()
  },
  methods: {
    searchPost(){
      axios.get('/api/posts/?search='+ this.search)
      .then(response => this.posts = response.data)
    },

    getPost(){
      axios.get('/api/posts')
        .then(response => this.posts = response.data)
    },
    destroy(id){
      axios.delete('/api/posts/'+ id)
      .then(response => this.getPost())
    },
    edit(id){
      axios.get('/api/posts/'+ id)
          .then(response => {
            console.log(response.data)  
            this.post = response.data
            this.$router.push({name: 'PostEdit'})
          })
          .catch(error => {
            console.log(error)
          })
    },
  }
}
</script>

<style>
  .float-end {
    margin-right: 145px;
  }
</style>
