import User from '../models/user';

declare module 'vue/types/vue' {
    interface Vue {
        user: User;
    }
}
