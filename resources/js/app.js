
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex'

Vue.use(Vuex)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('auth', require('./components/Auth.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('register', require('./components/Register.vue').default);

Vue.component('property-list', require('./components/PropertyList.vue').default);
Vue.component('property-create', require('./components/PropertyCreate.vue').default);
Vue.component('single-object', require('./components/SingleObject.vue').default);
Vue.component('book-object', require('./components/BookObject.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
    state: {
        stardata: "My star data"
    },
    mutations: {

    },
    getters:{
        countStarData: state => {
            return state.stardata.length
        }
    }

});

const app = new Vue({
    el: '#app',
    store: store
});

export default store;
