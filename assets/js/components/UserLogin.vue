<template>
    <section class="section">
        <div class="columns is-centered">
            <b-notification
                v-if="form.error"
                class="column is-one-quarter"
                type="is-warning"
                :aria-close-label="$t('common.notification.close')"
                role="alert"
            >
                {{ $t('sign_in.error.invalid_credentials') }}
            </b-notification>
        </div>
        <div class="columns is-centered">
            <div class="column is-half has-text-centered">
                {{ $t('sign_in.sign_up.question') }}
                <router-link :to="{ name: 'register' }">
                    {{ $t('sign_in.sign_up.action') }}
                </router-link>
            </div>
        </div>
        <div class="columns is-centered">
            <form class="column is-half" @submit="login">
                <b-field :label="$t('user.username')">
                    <b-input v-model="form.username" required></b-input>
                </b-field>
                <b-field :label="$t('user.password.main')">
                    <b-input
                        type="password"
                        v-model="form.password"
                        password-reveal
                        required
                    ></b-input>
                </b-field>
                <b-field>
                    <b-checkbox v-model="form.rememberMe" class="is-small">
                        {{ $t('sign_in.remember_me') }}
                    </b-checkbox>
                </b-field>
                <div class="buttons is-centered">
                    <b-button
                        tag="input"
                        native-type="submit"
                        type="is-light"
                        :value="$t('sign_in.action')"
                    />
                </div>
            </form>
        </div>
    </section>
</template>

<script lang="ts">
import HTTP, { API } from '../http-common';
import {defineComponent} from "@vue/composition-api";

export default defineComponent({
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
                        message: this.$t('sign_in.error.fetched_user').toString(),
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
