import User from '../models/User';

declare module 'vue/types/vue' {
  // eslint-disable-next-line no-unused-vars
  interface Vue {
    user: User;
  }
}
