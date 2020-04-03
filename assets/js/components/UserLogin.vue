<template>
  <form>
    <b-field label="Identifiant">
      <b-input :value="form.username"></b-input>
    </b-field>
    <b-field label="Mot de passe">
      <b-input type="password" :value="form.password"></b-input>
    </b-field>
    <b-button type="is-light" @click="login"></b-button>
  </form>
</template>

<script lang="ts">
  import Vue from 'vue';
  import { API } from '../http-common';

  export default Vue.extend({
    name: 'Login',
    data: () => {
      return {
        form: {
          username: '',
          password: ''
        }
      };
    },
    methods: {
      login() {}
    }
  });
</script>

<style lang="scss" scoped></style>
