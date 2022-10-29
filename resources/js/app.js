import { createApp } from 'vue'
import VueCookies from 'vue-cookies'

import router from '@/router'
import App from '@/components/App.vue'

import { createPinia } from './../../node_modules/pinia'
const pinia = createPinia()
// import '~/plugins'
// import './components'

import './bootstrap'
import '../css/app.css';


const app = createApp(App)
app.use(pinia)
app.use(VueCookies)
app.use(router)
app.mount('#app')
