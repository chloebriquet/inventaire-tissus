<template>
  <div id="app">
    <Navbar :user="$root.user" :is-loaded="$root.isLoaded" />
    <router-view></router-view>
  </div>
</template>

<script lang="ts">
  import Vue from 'vue';
  import Navbar from './Navbar.vue';

  export default Vue.extend({
    name: 'App',
    components: {
      Navbar
    }
  });
</script>

<style lang="scss" scoped></style>
