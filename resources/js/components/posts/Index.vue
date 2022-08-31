<template>
  <div class="container">
    <router-link :to="{ name: 'PostCreate' }" class="btn btn-sm btn-primary">Add Post</router-link>
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
      }
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
      Swal.fire({
      title: 'Are you sure to Delete?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {
        axios.delete('/api/posts/'+ id)
        .then(response =>{
          this.getPost()
          Swal.fire({ title: 'Deleted', icon: 'success' })
          Toast.fire({ icon: 'success', title: 'Deleted successfully'})
        })
      }
    })
      
    },
    edit(id){
      axios.get('/api/posts/'+ id)
          .then(response => {
            this.post = response.data
            this.$router.push({name: 'PostEdit'})
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
