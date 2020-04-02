import Vue from 'vue';
import VueRouter from "vue-router";
import Buefy from 'buefy';

import '@mdi/font/css/materialdesignicons.min.css';
import '../scss/bulmaswatch.scss';

import App from './components/App.vue';
import router from "./router";

Vue.use(VueRouter);
Vue.use(Buefy);

Vue.config.productionTip = false;

new Vue({
    el: '#app',
    template: '<App/>',
    components: { App },
    router
});
