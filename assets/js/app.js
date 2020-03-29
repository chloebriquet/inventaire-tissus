import Vue from 'vue';
import Buefy from 'buefy';

import 'buefy/dist/buefy.css';
import '@mdi/font/css/materialdesignicons.min.css';

import App from './view/App.vue';

Vue.use(Buefy);

import '../css/app.css';

Vue.config.productionTip = false;

new Vue({
    el: '#app',
    template: '<App/>',
    components: { App }
});
