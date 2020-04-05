import Vue from 'vue';
import VueRouter from 'vue-router';
import Buefy from 'buefy';

import '@mdi/font/css/materialdesignicons.min.css';
import '../scss/bulmaswatch.scss';

import App from './components/App.vue';
import User from './models/user';
import router from './router';

Vue.use(VueRouter);
Vue.use(Buefy);

Vue.config.productionTip = false;

declare global {
  interface Window {
    user: null | User;
  }
}

new Vue({
  el: '#app',
  template: '<App/>',
  components: { App },
  router,
  data() {
    return {
      user: {} as User,
      isLoaded: false as boolean
    };
  },
  mounted(): void {
    document.onreadystatechange = () => {
      if (document.readyState === 'complete') {
        this.isLoaded = true;

        if (null !== window.user) {
          this.user = window.user;
        }
      }
    };
  }
});
