<template>
    <div class="container">
      <nav class="my-5">
        <router-link :to= "{ name: 'PostIndex' }">See All Posts</router-link>
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
