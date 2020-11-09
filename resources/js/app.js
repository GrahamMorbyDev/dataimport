require('./bootstrap');
import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueAxios from 'vue-axios'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueAxios, axios)
Vue.use(require('vue-moment'));

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

//Main pages
import App from './views/app.vue'


const app = new Vue({
    el: '#app',
    components: { App }
});
