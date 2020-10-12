import VueRouter from 'vue-router';

import FabricElement from './components/FabricElement.vue';
import FabricList from './components/FabricList.vue';
import FabricForm from './components/FabricForm.vue';
import ColorList from './components/ColorList.vue';
import ColorForm from './components/ColorForm.vue';
import Login from './components/UserLogin.vue';
import Register from './components/UserRegister.vue';
import Profile from './components/UserProfile.vue';
import Home from './components/Home.vue';
import NotFound from './components/NotFound.vue';

const routes = [
    { path: '/fabrics', name: 'fabric_list', component: FabricList },
    { path: '/fabrics/add', name: 'fabric_add', component: FabricForm },
    { path: '/fabrics/:fabricId', name: 'fabric_show', component: FabricElement },
    { path: '/fabrics/:fabricId/edit', name: 'fabric_edit', component: FabricForm },
    { path: '/colors', name: 'color_list', component: ColorList },
    { path: '/colors/add', name: 'color_add', component: ColorForm },
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
    { path: '/profile', name: 'profile', component: Profile },
    { path: '/', name: 'home', component: Home },
    { path: '*', name: 'not_found', component: NotFound }
];

export default new VueRouter({
    mode: 'history',
    routes
});
