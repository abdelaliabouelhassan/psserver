/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('mainApp', require('./components/main').default);
Vue.component('banner', require('./components/includes/banner').default);
Vue.component('footer_app', require('./components/includes/footer').default);
Vue.component('header_app', require('./components/includes/header').default);
Vue.component('ad_app', require('./components/includes/ad').default);
Vue.component('right', require('./components/includes/right').default);
Vue.component('main_app', require('./components/includes/main').default);
Vue.component('login', require('./components/app/auth/login').default);
Vue.component('register', require('./components/app/auth/register').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**********   packages   ***********/
/*axios*/
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
/*End axios*/

/*Vue Router*/
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import routes from './router/router.js'
const router = new VueRouter({
    mode: 'history',
    routes
})
/*End Vue Router*/

/*Vuex*/
import store from './store/store'
/*End Vuex*/


/********** End  packages  ***********/




const app = new Vue({
    el: '#app',
    store,
    router
});
