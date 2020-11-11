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
            <form class="column is-half" @submit="signUp">
                <b-field
                    :label="$t('user.username')"
                    :message="form.username.error"
                    :type="{ 'is-danger': form.username.error }"
                >
                    <b-input v-model="form.username.field" required></b-input>
                </b-field>
                <b-field
                    :label="$t('user.email.main')"
                    :message="form.email.error"
                    :type="{ 'is-danger': form.email.error }"
                >
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
                        :validation-message="
                            $t('user.password.validation.message')
                        "
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
                <b-field
                    :label="$t('code')"
                    :message="form.code.error"
                    :type="{ 'is-danger': form.code.error }"
                >
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
import { defineComponent } from '@vue/composition-api';
import { API } from '../utils/http-common';
import Violation from '../types/Violation';
import FormField from '../types/FormField';
import Notification from '../utils/notification/Notification';

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
                code: new FormField()
            } as { [key: string]: FormField },
            notification: new Notification() as Notification
        };
    },
    methods: {
        signUp(event: Event) {
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
                .then(() => {
                    this.resetForm();
                    this.notification.creationSuccess();
                    this.$router.push({ name: 'login' });
                })
                .catch(error => {
                    if (400 === error.response.status) {
                        const data = error.response.data;
                        data.violations.forEach((violation: Violation) => {
                            if (violation.propertyPath in this.form) {
                                this.form[violation.propertyPath].error +=
                                    violation.message + ' ';
                            }
                        });
                    } else {
                        this.notification.creationError();
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
        resetFields(): void {
            this.form.username.resetField();
            this.form.email.resetField();
            this.form.emailConfirmation.resetField();
            this.form.password.resetField();
            this.form.passwordConfirmation.resetField();
            this.form.code.resetField();
        },
        resetForm(): void {
            this.resetErrors();
            this.resetFields();
        }
    }
});
</script>

<style lang="scss" scoped></style>
