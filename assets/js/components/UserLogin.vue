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
            <div class="column is-half has-text-centered">
                Pas encore de compte ?
                <router-link :to="{ name: 'register' }"
                    >Enregistre-toi !</router-link
                >
            </div>
        </div>
        <div class="columns is-centered">
            <form class="column is-half" @submit="login">
                <b-field label="Identifiant">
                    <b-input v-model="form.username" required></b-input>
                </b-field>
                <b-field label="Mot de passe">
                    <b-input
                        type="password"
                        v-model="form.password"
                        password-reveal
                        required
                    ></b-input>
                </b-field>
                <b-field>
                    <b-checkbox v-model="form.rememberMe" class="is-small">
                        Se souvenir de moi
                    </b-checkbox>
                </b-field>
                <div class="buttons is-centered">
                    <b-button
                        tag="input"
                        native-type="submit"
                        type="is-light"
                        value="Se connecter"
                    />
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
                    rememberMe: false as boolean,
                    error: '' as string
                }
            };
        },
        methods: {
            login(event: Event) {
                event.preventDefault();

                this.resetError();

                const formData: FormData = new FormData();
                formData.append('username', this.form.username);
                formData.append('password', this.form.password);
                formData.append(
                    '_remember_me',
                    this.form.rememberMe ? 'on' : ''
                );

                API.post('/login', formData)
                    .then(response => {
                        this.resetForm();
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
            },
            resetError(): void {
                this.form.error = '';
            },
            resetFields(): void {
                this.form.username = '';
                this.form.password = '';
                this.form.rememberMe = false;
            },
            resetForm(): void {
                this.resetError();
                this.resetFields();
            }
        }
    });
</script>

<style lang="scss" scoped>
    section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex-grow: 1;
    }
</style>
