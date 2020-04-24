<template>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-one-third has-text-centered">
                Déjà un compte ?
                <router-link :to="{ name: 'login' }"
                    >Connecte-toi !</router-link
                >
            </div>
        </div>
        <div class="columns is-centered">
            <form class="column is-one-third" @submit="register">
                <b-field
                    label="Identifiant"
                    :message="form.username.error"
                    :type="form.username.error ? 'is-danger' : ''"
                >
                    <b-input v-model="form.username.field"></b-input>
                </b-field>
                <b-field
                    label="Email"
                    :message="form.email.error"
                    :type="form.email.error ? 'is-danger' : ''"
                >
                    <b-input type="email" v-model="form.email.field"></b-input>
                </b-field>
                <b-field
                    label="Confirmer l'email"
                    :message="form.emailConfirmation.error"
                    :type="form.emailConfirmation.error ? 'is-danger' : ''"
                >
                    <b-input
                        type="email"
                        v-model="form.emailConfirmation.field"
                    ></b-input>
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
                <b-field
                    label="Confirmer le mot de passe"
                    :message="form.passwordConfirmation.error"
                    :type="form.passwordConfirmation.error ? 'is-danger' : ''"
                >
                    <b-input
                        type="password"
                        v-model="form.passwordConfirmation.field"
                    ></b-input>
                </b-field>
                <b-field
                    label="Code"
                    :message="form.code.error"
                    :type="form.code.error ? 'is-danger' : ''"
                >
                    <b-input v-model="form.code.field"></b-input>
                </b-field>
                <div class="buttons is-centered">
                    <b-field type="is-light">
                        <b-input type="submit" value="S'enregistrer"></b-input>
                    </b-field>
                </div>
            </form>
        </div>
    </section>
</template>

<script lang="ts">
    import Vue from 'vue';
    import { API } from '../http-common';

    export default Vue.extend({
        name: 'Register',
        data() {
            return {
                form: {
                    username: {
                        field: '' as string,
                        error: '' as string
                    },
                    email: {
                        field: '' as string,
                        error: '' as string
                    },
                    emailConfirmation: {
                        field: '' as string,
                        error: '' as string
                    },
                    password: {
                        field: '' as string,
                        error: '' as string
                    },
                    passwordConfirmation: {
                        field: '' as string,
                        error: '' as string
                    },
                    code: {
                        field: '' as string,
                        error: '' as string
                    },
                    error: '' as string
                }
            };
        },
        methods: {
            register(event: Event) {
                event.preventDefault();
                this.form.error = '';

                const formData = {
                    username: this.form.username.field as string,
                    email: this.form.email.field as string,
                    emailConfirmation: this.form.emailConfirmation
                        .field as string,
                    password: this.form.password.field as string,
                    passwordConfirmation: this.form.passwordConfirmation
                        .field as string,
                    code: this.form.code.field as string
                };

                API.post('/users', formData)
                    .then(response => {
                        this.resetForm();
                        this.$router.push({ name: 'login' });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            resetForm(): void {
                this.form.username.field = '';
                this.form.username.error = '';

                this.form.email.field = '';
                this.form.email.error = '';

                this.form.emailConfirmation.field = '';
                this.form.emailConfirmation.error = '';

                this.form.password.field = '';
                this.form.password.error = '';

                this.form.passwordConfirmation.field = '';
                this.form.passwordConfirmation.error = '';

                this.form.code.field = '';
                this.form.code.error = '';
            }
        }
    });
</script>

<style lang="scss" scoped></style>
