<template>
    <div class="container">
      <nav class="navbar navbar-expand-lg bg-light mb-5">
        <div class="container-fluid">
          <h1>Laravel + VueJs</h1>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
              <li class="nav-item">
                <router-link :to="{ name: 'PostIndex' }" class="">Post List</router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'UserIndex' }" class="">User List</router-link>
              </li>
             
            </ul>
          </div>
        </div>
      </nav>
      <router-view />
    </div>
</template>

<script>
export default {
  
}
</script>

<style>

</style>
