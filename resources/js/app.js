/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createVuetify } from 'vuetify'
import { createRouter, createWebHistory } from 'vue-router'
import bottomNavigationVue from "bottom-navigation-vue";
import VueSweetalert2 from 'vue-sweetalert2'
import "bottom-navigation-vue/dist/style.css";
// Vuetify
import 'vuetify/styles'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import 'sweetalert2/dist/sweetalert2.min.css'
import VueQrcodeReader from "vue3-qrcode-reader";

const vuetify = createVuetify({
  components,
  directives,
   icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    }
  },
})


//Vue Router
import routes from './components/Routes/Routes'

const router = createRouter({
  history:createWebHistory(import.meta.env.BASE_URL),
  routes
})

// bottom-navigation-vue

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({
});

app.use(vuetify)
app.use(VueSweetalert2)
app.use(router)
app.use(bottomNavigationVue);
app.use(VueQrcodeReader)
import ExampleComponent from './components/_Index.vue';
app.component('app-component', ExampleComponent);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
