/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');
import Vuetify from 'vuetify';
import 'material-design-icons-iconfont/dist/material-design-icons.css'
Vue.use(Vuetify);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('recomendador-component', require('./components/Recomendador.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify()
});

