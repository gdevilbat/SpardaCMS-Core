require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import Vuetify from 'vuetify'
import Vuex from 'vuex';
import VueMeta from 'vue-meta'
import FileManager from "laravel-file-manager"
import DataTable from 'laravel-vue-datatable';

Vue.use(Vuex);
Vue.use(Vuetify)
Vue.use(VueRouter)
Vue.use(VueMeta)
Vue.use(BootstrapVue)
Vue.use(DataTable)
Vue.use(Vuelidate)

const store = new Vuex.Store();
Vue.use(FileManager, {store});

/**
* The following block of code may be used to automatically register your
* Vue components. It will recursively scan this directory for the Vue
* components and automatically register them with their "basename".
*
* Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
*/

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/

const LoginPage = () => import('^/Core/Resources/assets/components/Login.vue')
const Template = () => import('^/Core/Resources/assets/components/Template.vue')

const Meta = {APP_NAME: process.env.MIX_APP_NAME,
    APP_URL: process.env.MIX_APP_URL,
    DISK: process.env.MIX_DISK,
    STORAGE_URL: process.env.MIX_APP_URL+'/storage'
};

const router = new VueRouter({
    mode : 'history',
    routes : [
        {
            path : '/control/auth/',
            name : 'login',
            component : LoginPage,
            meta: { 
                APP_NAME: process.env.MIX_APP_NAME,
                APP_URL: process.env.MIX_APP_URL,
            }
        },
        {
            path : '/control/spa',
            name: 'template',
            component : Template,
        },
    ]
})

const files = require.context('^', true, /[a-zA-Z0-9].+\/Resources\/assets\/js\/routes\.js$/i);
files.keys().map(function(key){
    const file = files(key).default;
    const object = new file(Meta);
    const routes =  object.route();

    routes.forEach(function(route){
        router.addRoute('template', route);
    })

});

new Vue({
    vuetify : new Vuetify(),
    store,
    el : '#main',
    router
})