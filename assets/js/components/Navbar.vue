<template>
    <b-navbar type="is-success">
        <template slot="brand">
            <b-navbar-item href="/">
                <b-icon icon="scissors-cutting" />
                <div>Yards and Co.</div>
            </b-navbar-item>
        </template>
        <template slot="start">
            <b-navbar-item tag="router-link" :to="{ name: 'fabric_list' }">
                Liste des tissus
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{ name: 'fabric_add' }">
                Ajouter un tissu
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{ name: 'color_list' }">
                Liste des couleurs
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{ name: 'color_add' }">
                Ajouter une couleur
            </b-navbar-item>
        </template>

        <template slot="end" v-if="isLoaded">
            <b-navbar-dropdown v-if="user.uuid" :label="user.username" right>
                <b-navbar-item tag="router-link" :to="{ name: 'profile' }">
                    Mon compte
                </b-navbar-item>
                <b-navbar-item href="#">
                    Se déconnecter
                </b-navbar-item>
            </b-navbar-dropdown>
            <b-navbar-item tag="div" v-else>
                <div class="buttons">
                    <b-button
                        tag="router-link"
                        :to="{ name: 'register' }"
                        type="is-primary"
                    >
                        <strong>S'enregistrer</strong>
                    </b-button>
                    <b-button
                        tag="router-link"
                        :to="{ name: 'login' }"
                        type="is-light"
                    >
                        Se connecter
                    </b-button>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>

<script lang="ts">
    import Vue from 'vue';
    import User from '../models/user';

    export default Vue.extend({
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
        }
    });
</script>

<style lang="scss" scoped>
    .navbar-brand span.icon + div {
        margin-left: 1rem;
    }
</style>
