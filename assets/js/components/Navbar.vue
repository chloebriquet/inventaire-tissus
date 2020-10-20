<template>
    <b-navbar type="is-success">
        <template slot="brand">
            <b-navbar-item tag="router-link" :to="{ name: 'home' }">
                <b-icon icon="scissors-cutting" />
                <div>{{ $t('site.name') }}</div>
            </b-navbar-item>
        </template>
        <template slot="start">
            <b-navbar-item tag="router-link" :to="{ name: 'fabric_list' }">
                {{ $t('nav.fabric.list') }}
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{ name: 'fabric_add' }">
                {{ $t('nav.fabric.add') }}
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{ name: 'color_list' }">
                {{ $t('nav.color.list') }}
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{ name: 'color_add' }">
                {{ $t('nav.color.add') }}
            </b-navbar-item>
        </template>

        <template slot="end" v-if="isLoaded">
            <b-navbar-dropdown v-if="user.uuid" :label="user.username" right>
                <b-navbar-item tag="router-link" :to="{ name: 'profile' }">
                    {{ $t('site.account') }}
                </b-navbar-item>
                <b-navbar-item @click="logout">
                    {{ $t('site.sign_out.action') }}
                </b-navbar-item>
            </b-navbar-dropdown>
            <b-navbar-item tag="div" v-else>
                <div class="buttons">
                    <b-button
                        tag="router-link"
                        :to="{ name: 'register' }"
                        type="is-primary"
                    >
                        <strong>{{ $t('site.sign_up.action') }}</strong>
                    </b-button>
                    <b-button
                        tag="router-link"
                        :to="{ name: 'login' }"
                        type="is-light"
                    >
                        {{ $t('site.sign_in.action') }}
                    </b-button>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import {API} from '../utils/http-common';
import User from '../models/User';
import Toast from '../utils/notification/Toast';

export default defineComponent({
    name: 'Navbar',
    props: {
        user: {
            type: Object as () => User,
            required: true
        },
        isLoaded: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            toast: new Toast() as Toast,
        }
    },
    methods: {
        logout(): void {
            API.post(window.location.origin + '/api/logout').finally(() => {
                this.$root.user = new User();
                this.toast.success('site.sign_out.message');
                this.$router.push({name: 'home'});
            });
        }
    }
});
</script>

<style lang="scss" scoped>
.navbar-brand span.icon + div {
    margin-left: 1rem;
}
</style>
