import {RouteRecordRaw} from "vue-router";

import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import PasswordRecovery from '../views/PasswordRecovery.vue';
import Personal from '../views/Personal.vue';

export const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        component: {template: '<h1>Main</h1>'}
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/password_recovery',
        name: 'password-recovery',
        component: PasswordRecovery
    },
    {
        path: '/personal',
        name: 'personal',
        component: Personal
    }
];
