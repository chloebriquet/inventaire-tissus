import User from '../models/User';

declare module 'vue/types/vue' {
    interface Vue {
        user: User;
    }
}
