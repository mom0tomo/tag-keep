<template>
  <div id="app">
      <navbar></navbar>
      <!-- <clip-loader v-if="loading" :size="size" class="loader"></clip-loader> -->
      <div class="container">
        <router-view></router-view>
      </div>
  </div>
</template>

<script>
  export default {
    components: {
      navbar: require('./components/Navbar.vue'),
    },
  }
</script>