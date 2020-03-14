import Vue from 'vue';
import App from './view/App.vue';

import '../css/app.css';

Vue.config.productionTip = false;

new Vue({
    el: '#app',
    template: '<App/>',
    components: { App }
});
