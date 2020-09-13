<template>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-half has-text-centered">
                Déjà un compte ?
                <router-link :to="{ name: 'login' }"
                    >Connecte-toi !</router-link
                >
            </div>
        </div>
        <div class="columns is-centered">
            <form class="column is-half" @submit="register">
                <b-field
                    label="Identifiant"
                    :message="form.username.error"
                    :type="form.username.error ? 'is-danger' : ''"
                >
                    <b-input v-model="form.username.field" required></b-input>
                </b-field>
                <b-field label="Email" :message="form.email.error">
                    <b-input
                        type="email"
                        v-model="form.email.field"
                        required
                    ></b-input>
                </b-field>
                <b-field
                    label="Confirmer l'email"
                    :message="form.emailConfirmation.error"
                    :type="form.emailConfirmation.error ? 'is-danger' : ''"
                >
                    <b-input
                        type="email"
                        v-model="form.emailConfirmation.field"
                        required
                        @click.right.native.prevent
                        @paste.native.prevent
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
                        pattern="^(?=.*?[a-zA-Z])(?=.*?[0-9])[a-zA-Z0-9!#\$%&'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]{8,}$"
                        validation-message="Le mot de passe doit contenir au moins 8 caractères dont une lettre, un chiffre et un caractère spécial (à l'exception de &quot; et ')."
                        password-reveal
                        required
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
                        password-reveal
                        required
                        @click.right.native.prevent
                        @paste.native.prevent
                    ></b-input>
                </b-field>
                <b-field label="Code" :message="form.code.error">
                    <b-input v-model="form.code.field" required></b-input>
                </b-field>
                <div class="buttons is-centered">
                    <b-button
                        tag="input"
                        native-type="submit"
                        type="is-light"
                        value="S'enregistrer"
                    />
                </div>
            </form>
        </div>
    </section>
</template>

<script lang="ts">
    import Vue from 'vue';
    import { API } from '../http-common';
    import Violation from '../types/violation';
    import FormField from '../types/formField';

    export default Vue.extend({
        name: 'Register',
        data() {
            return {
                form: {
                    username: new FormField(),
                    email: new FormField(),
                    emailConfirmation: new FormField(),
                    password: new FormField(),
                    passwordConfirmation: new FormField(),
                    code: new FormField(),
                    error: '' as string
                } as { [key: string]: any }
            };
        },
        methods: {
            register(event: Event) {
                event.preventDefault();

                this.resetErrors();

                const formData: { [key: string]: string } = {
                    username: this.form.username.field,
                    email: this.form.email.field,
                    emailConfirmation: this.form.emailConfirmation.field,
                    password: this.form.password.field,
                    passwordConfirmation: this.form.passwordConfirmation.field,
                    code: this.form.code.field
                };

                API.post('/users', formData)
                    .then(response => {
                        this.resetForm();
                        this.$buefy.toast.open({
                            duration: 3000,
                            message: `L'enregistrement a bien été effectué.`,
                            position: 'is-top',
                            type: 'is-info'
                        });
                        this.$router.push({ name: 'login' });
                    })
                    .catch(error => {
                        const status = error.response.status;

                        if (400 === status) {
                            const data = error.response.data;
                            data.violations.forEach((violation: Violation) => {
                                if (violation.propertyPath in this.form) {
                                    this.form[violation.propertyPath].error +=
                                        violation.message + ' ';
                                }
                            });
                        } else {
                            this.$buefy.notification.open({
                                duration: 5000,
                                message: `Un problème est survenu lors de l'enregistrement. Merci de t'adresser à l'administratrice du site (à savoir Chloé).`,
                                position: 'is-bottom',
                                type: 'is-danger'
                            });
                        }
                    });
            },
            resetErrors(): void {
                this.form.username.resetError();
                this.form.email.resetError();
                this.form.emailConfirmation.resetError();
                this.form.password.resetError();
                this.form.passwordConfirmation.resetError();
                this.form.code.resetError();
            },
            resetForm(): void {
                this.form.username.field = new FormField();
                this.form.email.field = new FormField();
                this.form.emailConfirmation.field = new FormField();
                this.form.password.field = new FormField();
                this.form.passwordConfirmation.field = new FormField();
                this.form.code.field = new FormField();
            }
        }
    });
</script>

<style lang="scss" scoped></style>
