<template>
  <form>
    <b-field label="Identifiant">
      <b-input v-model="form.username"></b-input>
    </b-field>
    <b-field label="Mot de passe">
      <b-input type="password" v-model="form.password"></b-input>
    </b-field>
    <b-button type="is-light" @click="login"></b-button>
  </form>
</template>

<script lang="ts">
  import Vue from 'vue';
  import HTTP, { API } from '../http-common';

  export default Vue.extend({
    name: 'Login',
    data() {
      return {
        form: {
          username: '' as string,
          password: '' as string
        }
      };
    },
    methods: {
      login() {
        const formData: FormData = new FormData();
        formData.append('username', this.form.username);
        formData.append('password', this.form.password);

        API.post('/login', formData)
          .then(response => {
            this.$data.form.username = '';
            this.$data.form.password = '';
            this.getUser(response.headers.location);
          })
          .catch(error => {
            console.error(error);
          });
      },
      getUser(uri: string) {
        HTTP.get(uri)
          .then(response => {
            this.$root.user = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      }
    }
  });
</script>

<style lang="scss" scoped></style>
