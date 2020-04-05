<template>
    <section class="section">
        <div class="columns">
            <form class="column is-one-third is-offset-one-third">
                <b-field label="Identifiant">
                    <b-input v-model="form.username"></b-input>
                </b-field>
                <b-field label="Mot de passe">
                    <b-input type="password" v-model="form.password"></b-input>
                </b-field>
                <b-field>
                    <b-checkbox v-model="form.rememberMe" class="is-small">
                        Se souvenir de moi
                    </b-checkbox>
                </b-field>
                <div class="buttons is-centered">
                    <b-button type="is-light" @click="login">
                        Se connecter
                    </b-button>
                </div>
            </form>
        </div>
    </section>
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
                    password: '' as string,
                    rememberMe: false as boolean
                }
            };
        },
        methods: {
            login() {
                const formData: FormData = new FormData();
                formData.append('username', this.form.username);
                formData.append('password', this.form.password);
                formData.append(
                    '_remember_me',
                    this.form.rememberMe ? 'on' : ''
                );

                API.post('/login', formData)
                    .then(response => {
                        this.$data.form.username = '';
                        this.$data.form.password = '';
                        this.$data.form.rememberMe = false;
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
