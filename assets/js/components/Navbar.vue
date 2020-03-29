<template>
    <b-navbar>
        <template slot="brand">
            <b-navbar-item href="/">
                <b-icon icon="scissors-cutting" size="is-large" />
            </b-navbar-item>
        </template>
        <template slot="start">
            <b-navbar-item href="#">
                Liste des tissus
            </b-navbar-item>
            <b-navbar-item href="#">
                Ajouter un tissu
            </b-navbar-item>
            <b-navbar-item href="#">
                Liste des couleurs
            </b-navbar-item>
            <b-navbar-item href="#">
                Ajouter une couleur
            </b-navbar-item>
        </template>

        <template slot="end">
            <b-navbar-dropdown
                    v-if="user"
                    :label="user.username"
                    right>
                <b-navbar-item href="#">
                    Mon compte
                </b-navbar-item>
                <b-navbar-item href="#">
                    Se déconnecter
                </b-navbar-item>
            </b-navbar-dropdown>
            <b-navbar-item tag="div" v-else>
                <div class="buttons">
                    <b-button tag="a" href="#" type="is-primary">
                        <strong>S'enregistrer</strong>
                    </b-button>
                    <b-button tag="a" href="#" type="is-light">
                        Se connecter
                    </b-button>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>

<script>
    export default {
        name: "Navbar",
        props: {
            user: Object,
        }
    }
</script>

<style scoped>

</style>
