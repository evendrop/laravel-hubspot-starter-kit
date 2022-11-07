import { createApp } from 'vue'
import VueCookies from 'vue-cookies'

import router from '@/router'
import { useRoute } from 'vue-router';
const route = useRoute();

import App from '@/components/App.vue'

import { createPinia } from './../../node_modules/pinia'
const pinia = createPinia()

import './bootstrap'
import '../css/app.css';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import './plugins/font-loader.js';

import Popper from "vue3-popper";

const app = createApp(App)
app.component('font-awesome-icon', FontAwesomeIcon)
app.component("Popper", Popper)
app.use(pinia)
app.use(VueCookies)
app.use(router)
app.use(route)
app.mount('#app')
