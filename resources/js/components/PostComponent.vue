<template>
  <div class="container">

     <a href="#" @click="logout" class="btn btn-danger ms-3 float-end">Logout</a>
   
    <h3>{{ isEdit ? 'Edit': 'Create'}}</h3>
    <form @submit.prevent="isEdit ? update() : store()">
        <div class="col-4">
            <div class="form-group">
                <label for="">Title : </label>
                <input type="text" v-model="post.title" class="form-control">
                <div v-if="errorMessage">
                    <span class="text-danger" v-for="error in errors.title" :key="error">{{ error }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="">Description : </label>
                <textarea v-model="post.description" class="form-control"></textarea>
                <div v-if="errorMessage">
                    <span class="text-danger" v-for="error in errors.description" :key="error">{{ error }}</span>
                </div>
            </div>
            <button class="btn btn-primary mt-3" type="submit">{{ isEdit? 'Update' : 'Create' }}</button>
        </div>
    </form>

    <div class="float-end col-3" @keyup="searchPost">
        <input type="search" class="form-control search" v-model="search">
    </div>
    <table class="table mt-5">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
      <tr v-for="post in posts" :key="post.id">
        <td>{{ post.id }}</td>
        <td>{{ post.title }}</td>
        <td>{{ post.description }}</td>
        <td>
          <button class="btn btn-sm btn-secondary text-dark" @click="edit(post)">Edit</button>
          <button class="btn btn-sm btn-danger text-dark ms-1" @click="destroy(post.id)">Delete</button>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>

import Test from './TestComponent.vue';

export default {
  name: 'PostComponent',
  data() {

    return {
        isEdit: false,
        search: '',
        posts: [],
        post: {
            id: '',
            title: '',
            description: ''
        },
        errors: [],
        errorMessage: false
    }
  },

  methods: {

    searchPost(){
        axios.get('/posts/?search='+ this.search)
        .then(response => this.posts = response.data)
    },

    index(){
        axios.get('/posts')
        .then(response => this.posts = response.data)
    },

    store(){
        axios.post('/posts', this.post)
        .then(response => {
            this.index();
            this.post = {id:'', title: '', description: ''}
            this.errorMessage = false
        })
        .catch(error => {
            this.errors = error.response.data.errors
            this.errorMessage = true
        })
    },

    edit(post){
        this.isEdit = true
        this.post.id = post.id
        this.post.title = post.title
        this.post.description = post.description
        this.errorMessage = false
    },

    update(){
        axios.put('/posts/'+ this.post.id, this.post)
        .then(response => {
            this.index();
            this.post = {id:'', title: '', description: ''}
            this.isEdit = false
            this.errorMessage = false
        })
        .catch(error => {
            this.errors = error.response.data.errors
            this.errorMessage = true
        })
    },

    destroy(id){
        Swal.fire({
        title: 'Are you sure?',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete!'
        }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('/posts/'+ id)
            .then(response => {
                this.index()
                Swal.fire({ title: 'Deleted!!', icon: 'success' })
            })
        }
        })
    },
    logout(){
        localStorage.clear();
        this.$router.push('/')
    }

  },
  created () {
        this.index()
  }
}
</script>

<style>
    .float-end {
        margin-right: 145px;
    }
</style>
