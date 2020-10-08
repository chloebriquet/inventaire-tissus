<template>
    <div id="app">
        <Navbar :user="$root.user" :is-loaded="$root.isLoaded" />
        <div class="columns is-centered">
            <div class="main column is-8">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import Navbar from './Navbar.vue';

export default defineComponent({
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
    flex-direction: column;
    flex-grow: 1;
    align-items: center;
    margin: 2rem 0;
}

.main.column {
    background-color: #fff;
    flex-grow: 1;
}
</style>
