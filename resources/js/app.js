/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');
import Vuetify from 'vuetify';
import 'material-design-icons-iconfont/dist/material-design-icons.css'
Vue.use(Vuetify);

Vue.component('header-component', require('./components/general/header.vue').default);
Vue.component('recomendador-component', require('./components/Recomendador.vue').default);

Vue.component('formula-component', require('./components/formula-eval.vue').default);
Vue.component('escala-component', require('./components/escala-eval.vue').default);
Vue.component('opciones-formula-component', require('./components/opciones-formula.vue').default);
Vue.component('selector-component', require('./components/general/selector.vue').default);
Vue.component('maestoeval-component', require('./components/maestro_eval.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify()
});

