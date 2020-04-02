import VueRouter from 'vue-router'

import FabricList from "./components/FabricList";
import FabricForm from "./components/FabricForm";
import ColorList from "./components/ColorList";
import ColorForm from "./components/ColorForm";
import Login from "./components/UserLogin";
import Register from "./components/UserRegister";
import Profile from "./components/UserProfile";
import NotFound from "./components/NotFound";

const routes = [
    { path: '/fabrics', name: 'fabric_list', component: FabricList },
    { path: '/fabrics/add', name: 'fabric_add', component: FabricForm },
    { path: '/colors', name: 'color_list', component: ColorList },
    { path: '/colors/add', name: 'color_add', component: ColorForm },
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
    { path: '/profile', name: 'profile', component: Profile },
    { path: '*', name: 'not_found', component: NotFound }
];

export default new VueRouter({
    mode: 'history',
    routes
})
