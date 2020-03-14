<template>
    <div id="app">
        <h1 v-if="user">Hi {{ user.username }}</h1>
        <h1 v-else>Hi you!</h1>
        <button @click="authenticate">Login</button>
        <button @click="logout">Logout</button>
    </div>
</template>

<script>
    import HTTP from "../http-common";

    export default {
        name: "App",
        data() {
            return {
                user: null
            }
        },
        mounted() {
            if (window.user) {
                this.user = window.user;
            }
        },
        methods: {
            authenticate() {
                const formData = new FormData();
                formData.append('username', 'chloe');
                formData.append('password', 'password');
                formData.append('_remember_me', 'on');

                HTTP
                    .post('/login', formData)
                    .then(response => {
                        HTTP
                            .get(response.headers.location)
                            .then(responseb => {
                                this.user = responseb.data;
                            });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            logout() {
                HTTP
                    .post('/logout')
                    .then(() => {
                        window.user = null;
                        this.user = null;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
