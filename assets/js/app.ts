import Vue from 'vue';
import VueRouter from 'vue-router';
import Buefy from 'buefy';
import i18n from './utils/i18n';

import '@mdi/font/css/materialdesignicons.min.css';
import '../scss/style.scss';

import './utils/compositionPlugin';

import App from './views/App.vue';
import User from './models/User';
import router from './router';

Vue.use(VueRouter);
Vue.use(Buefy);

Vue.config.productionTip = false;

declare global {
  // eslint-disable-next-line no-unused-vars
  interface Window {
    user: null | User;
  }
}

// eslint-disable-next-line no-new
new Vue({
  el: '#app',
  components: { App },
  data() {
    return {
      user: {} as User,
      isLoaded: false as boolean,
    };
  },
  mounted(): void {
    document.onreadystatechange = () => {
      if (document.readyState === 'complete') {
        this.isLoaded = true;

        if (window.user !== null) {
          this.user = window.user;
        }
      }
    };
  },
  template: '<App/>',
  router,
  i18n,
});
