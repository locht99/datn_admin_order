require('./bootstrap');
require('flowbite');

import { createApp } from 'vue';

import TestView from './components/Test'

const app = createApp({})

app.component('test-view', TestView)

app.mount('#app')