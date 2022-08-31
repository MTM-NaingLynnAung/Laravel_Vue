<template>
  <div class="container">
    <h3>Edit Post</h3>
    <form @submit.prevent="update()" enctype="multipart/form-data">
      <div class="col-4">
        <div class="form-group">
          <label for="">Title : </label>
          <input type="text" v-model="post.title" class="form-control" />
          <div v-if="errorMessage">
            <span
              class="text-danger"
              v-for="error in errors.title"
              :key="error"
              >{{ error }}</span
            >
          </div>
        </div>
        <div class="form-group">
          <label for="">Description : </label>
          <textarea v-model="post.description" class="form-control"></textarea>
          <div v-if="errorMessage">
            <span
              class="text-danger"
              v-for="error in errors.description"
              :key="error"
              >{{ error }}</span
            >
          </div>
        </div>
        <div class="form-group">
          <label for="">Image :</label>
          <input type="file" class="form-control mb-3" @change="onChange" name="image" />
          <img :src="imagePreview" width="100" height="100" />
        </div>
        <button class="btn btn-primary mt-3" type="submit">Update</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      post: {
        id: "",
        title: "",
        description: "",
        image: "",
      },
      errorMessage: false,
      error: [],
      imagePreview: null,
    };
  },
  methods: {
    update() {
        

        console.log('update', this.post)

        axios.put("/api/posts/" + this.post.id, this.post)
            .then((response) => {
            this.$router.push({ name: "PostIndex" });
            this.errorMessage = false;
            })
            .catch((error) => {
            this.errors = error.response.data.errors;
            this.errorMessage = true;
            });
    },

    onChange(e) {
      this.post.image = e.target.files[0];
      console.log(this.post);
      let reader = new FileReader();
      reader.addEventListener(
        "load",
        function () {
          this.imagePreview = reader.result;
        }.bind(this),
        false
      );
      if (this.post.image) {
        reader.readAsDataURL(this.post.image);
      }
    },
  },
  created() {
    this.post.id = this.$route.params.id;
    axios.get("/api/posts/" + this.post.id).then((response) => {
      this.post = response.data;
      this.imagePreview = this.post.image;
    });
  },
};
</script>

<style>
</style>
