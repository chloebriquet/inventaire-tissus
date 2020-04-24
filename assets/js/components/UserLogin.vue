<template>
    <section class="section">
        <div class="columns is-centered">
            <b-notification
                v-if="form.error"
                class="column is-one-quarter"
                type="is-warning"
                aria-close-label="Close notification"
                role="alert"
            >
                L'utilisateur et/ou le mot de passe sont incorrects.
            </b-notification>
        </div>
        <div class="columns is-centered">
            <div class="column is-one-third has-text-centered">
                Pas encore de compte ?
                <router-link :to="{ name: 'register' }"
                    >Enregistre-toi !</router-link
                >
            </div>
        </div>
        <div class="columns is-centered">
            <form class="column is-one-third">
                <b-field
                    label="Identifiant"
                    :message="form.username.error"
                    :type="form.username.error ? 'is-danger' : ''"
                >
                    <b-input v-model="form.username.field"></b-input>
                </b-field>
                <b-field
                    label="Mot de passe"
                    :message="form.password.error"
                    :type="form.password.error ? 'is-danger' : ''"
                >
                    <b-input
                        type="password"
                        v-model="form.password.field"
                    ></b-input>
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
                    username: {
                        field: '' as string,
                        error: '' as string
                    },
                    password: {
                        field: '' as string,
                        error: '' as string
                    },
                    rememberMe: false as boolean,
                    error: '' as string
                }
            };
        },
        methods: {
            login() {
                this.form.username.error = '';
                this.form.password.error = '';

                if (!this.form.username.field || !this.form.password.field) {
                    const error = 'Merci de renseigner ce champ.';

                    if (!this.form.username.field) {
                        this.form.username.error = error;
                    }

                    if (!this.form.password.field) {
                        this.form.password.error = error;
                    }

                    return;
                }

                this.form.error = '';

                const formData: FormData = new FormData();
                formData.append('username', this.form.username.field);
                formData.append('password', this.form.password.field);
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
                        this.$router.push({ name: 'home' });
                    })
                    .catch(error => {
                        this.form.error = error;
                    });
            },
            getUser(uri: string) {
                HTTP.get(uri)
                    .then(response => {
                        this.$root.user = response.data;
                    })
                    .catch(() => {
                        this.$buefy.notification.open({
                            duration: 5000,
                            message: `Un problème est survenu lors de la récupération de l'utilisateur. Merci de t'adresser à l'administratrice du site (à savoir Chloé).`,
                            position: 'is-bottom',
                            type: 'is-danger'
                        });
                    });
            }
        }
    });
</script>

<style lang="scss" scoped></style>
