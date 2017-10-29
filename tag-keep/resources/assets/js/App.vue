<template>
  <div id="app">
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