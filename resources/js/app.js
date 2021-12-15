/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
/**
 * Intialize extension pkg
 */
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
import VueRouter from 'vue-router'
import Vuex from 'vuex'

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(Vuex);

import Components from './components/components';
import router from './components/router';
import store from './components/store/index';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('App', require('./components/App.vue').default);
Vue.component('Login', Components.Login);
Vue.component('AdminLayout', Components.AdminLayout);
Vue.component('PracticeProfile', Components.PracticeProfile);
Vue.component('TeamMember', Components.TeamMember);

Vue.component('Segment', Components.Segment);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.onload = function(e) {
    const app = new Vue({
        el: '#app',
        router: router,
        vuetify: new Vuetify(),
        store:store
    });
}

