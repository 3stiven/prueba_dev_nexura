/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vuetify from 'vuetify'
import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(Vuetify);
Vue.use(VueRouter)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('administrador-component', require('./components/Administrador/AdministradorComponent.vue').default);

Vue.component('asignar-component', require('./components/Administrador/AsignarCursoComponent.vue').default);


let create_component = {
    template: `<administrador-component></administrador-component>`
}
let asignar_component = {
    template: `<asignar-component></asignar-component>`
    // template: `<usuario-component></usuario-component>`
}
let listar_component = {
    template: `<administrador-component></administrador-component>`
    // template: `<usuario-component></usuario-component>`
}
// let miscursos_component = {
//     template: `<administrador-component></administrador-component>`
//     // template: `<usuario-component></usuario-component>`
// }

const router = new VueRouter({
    routes: [

        {
            path: '/administrador/create',
            name: 'Crear',
            component: create_component,
            

        },
    ],
    mode: 'history'
})


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    data: () => ({
        drawer_help: true,
        loading_get_info :false,
        itemsCrud: [
            {
                icon: "mdi-file-edit-outline",
                text: "Crear Empleado",
                ruta: "/administrador/create",
                color: "#c12120",
                rol:"1"
            }, 
        ],

    })

});


