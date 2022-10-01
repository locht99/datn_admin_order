require('./bootstrap');
require('flowbite');

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import App from './App.vue';
import routes from './routes';
import VueAxios from 'vue-axios';
import axios from 'axios';
import driverAuthBearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
import { createAuth } from '@websanova/vue-auth';

const router = createRouter({
    history: createWebHistory(),
    routes,
})


library.add(fas, fab, far);
// window.Vue = Vue
const baseURL = "http://localhost:8000/api/"
var auth = createAuth({
    plugins: {
        http: axios,
        router: router
    },
    drivers: {
        http: driverHttpAxios,
        auth: driverAuthBearer,
        router: driverRouterVueRouter,
        tokenDefaultName: 'auth-token',
        tokenStore: ['localStorage'],
        notFoundRedirect: {
            path: '/home'
        },

    },
    options: {
        rolesKey: 'type',
        notFoundRedirect: { name: 'user-account' },
        loginData: {
            url: baseURL + 'login',
            method: 'POST',
            redirect: '/',
            fetchUser: true,
            makeRequest: true,
        },
        logoutData: {
            url: baseURL + 'logout',
            method: 'POST',
            redirect: '/login',
            makeRequest: true
        },
        fetchData: {
            url: baseURL + 'user',
            method: 'GET',
            enabled: true
        },
        parseUserData(data) {
            return data || {}
        },
    }
});
const app = createApp(App)
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(VueAxios, axios)
app.use(router);
app.use(VueSweetalert2);
app.use(Toast)
app.use(auth);
app.mount('#app')