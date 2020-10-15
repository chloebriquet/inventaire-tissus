<template>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-half has-text-centered">
                {{ $t('sign_up.sign_in.question') }}
                <router-link :to="{ name: 'login' }">
                    {{ $t('sign_up.sign_in.action') }}
                </router-link>
            </div>
        </div>
        <div class="columns is-centered">
            <form class="column is-half" @submit="register">
                <b-field
                    :label="$t('user.username')"
                    :message="form.username.error"
                    :type="{ 'is-danger': form.username.error }"
                >
                    <b-input v-model="form.username.field" required></b-input>
                </b-field>
                <b-field :label="$t('user.email.main')" :message="form.email.error" :type="{ 'is-danger': form.email.error }">
                    <b-input
                        type="email"
                        v-model="form.email.field"
                        required
                    ></b-input>
                </b-field>
                <b-field
                    :label="$t('user.email.confirm')"
                    :message="form.emailConfirmation.error"
                    :type="{ 'is-danger': form.emailConfirmation.error }"
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
                    :label="$t('user.password.main')"
                    :message="form.password.error"
                    :type="{ 'is-danger': form.password.error }"
                >
                    <b-input
                        type="password"
                        v-model="form.password.field"
                        :pattern="$t('user.password.validation.regex')"
                        :validation-message="$t('user.password.validation.message')"
                        password-reveal
                        required
                    ></b-input>
                </b-field>
                <b-field
                    :label="$t('user.password.confirm')"
                    :message="form.passwordConfirmation.error"
                    :type="{ 'is-danger': form.passwordConfirmation.error }"
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
                <b-field :label="$t('code')" :message="form.code.error" :type="{ 'is-danger': form.code.error }">
                    <b-input v-model="form.code.field" required></b-input>
                </b-field>
                <div class="buttons is-centered">
                    <b-button
                        tag="input"
                        native-type="submit"
                        type="is-light"
                        :value="$t('sign_up.action')"
                    />
                </div>
            </form>
        </div>
    </section>
</template>

<script lang="ts">
import {API} from '../http-common';
import Violation from '../types/violation';
import FormField from '../types/formField';
import {defineComponent} from '@vue/composition-api';

export default defineComponent({
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
