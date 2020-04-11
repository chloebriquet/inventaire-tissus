<template>
    <div id="app">
        <Navbar :user="$root.user" :is-loaded="$root.isLoaded" />
        <div id="notification-container"></div>
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

<style lang="scss" scoped>
    #notification-container {
        position: fixed;
        top: 3.25rem;
        width: 100vw;
        height: 100vh;
        z-index: -10;
    }
</style>
