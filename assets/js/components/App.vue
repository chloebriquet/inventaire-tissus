<template>
  <div id="app">
    <Navbar :user="user" />
    <router-view></router-view>
  </div>
</template>

<script lang="ts">
  import Vue from 'vue';
  import HTTP from '../http-common';
  import Navbar from './Navbar.vue';
  import User from '../models/user';

  export default Vue.extend({
    name: 'App',
    components: {
      Navbar
    },
    data() {
      return {
        user: null as null | User
      };
    },
    mounted() {
      if (window.user) {
        this.user = window.user;
      }
    },
    methods: {
      authenticate() {
        const formData = new FormData();
        formData.append('username', 'chloe');
        formData.append('password', 'password');
        formData.append('_remember_me', 'on');

        HTTP.post('/login', formData)
          .then(response => {
            HTTP.get(response.headers.location).then(responseb => {
              this.user = responseb.data;
            });
          })
          .catch(error => {
            console.log(error);
          });
      },
      logout() {
        HTTP.post('/logout').then(() => {
          window.user = null;
          this.user = null;
        });
      }
    }
  });
</script>

<style lang="scss" scoped></style>
