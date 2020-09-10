<template>
    <div id="app">
        <Navbar :user="$root.user" :is-loaded="$root.isLoaded" />
        <div class="columns is-centered">
            <div class="main column is-two-thirds">
                <router-view></router-view>
            </div>
        </div>
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
    #app {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .columns {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        align-items: center;
        margin: 2rem 0;
    }

    .main.column {
        background-color: #fff;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
</style>
