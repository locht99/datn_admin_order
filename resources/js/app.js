require('./bootstrap');
require('flowbite');

import { createApp, Vue } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import VueTailwindModal from "vue-tailwind-modal"

import App from './App.vue';
import routes from './routes';
const router = createRouter({
    history: createWebHistory(),
    routes,
})


library.add(fas, fab, far);
const app = createApp(App)
app.component('font-awesome-icon', FontAwesomeIcon)
app.component("VueTailwindModal", VueTailwindModal)
app.use(router);
app.use(VueSweetalert2);
app.mount('#app')