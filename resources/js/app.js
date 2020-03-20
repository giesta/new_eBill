/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

//Import Vue Filter
require("./filter");

//Import progressbar
require("./progressbar");

//Setup custom events
require("./customEvents");

//Import permissions
import Permissions from "./mixins/Permissions";
Vue.mixin(Permissions);

//Import View Router
import VueRouter from "vue-router";
Vue.use(VueRouter);

import Vue from "vue";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";

// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

//Import v-from
import { Form, HasError, AlertError } from "vform";
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "../sass/app.scss";

import { BBadge } from "bootstrap-vue";
Vue.component("b-badge", BBadge);

//Routes

import { routes } from "./routes";

//Register Routes
const router = new VueRouter({
    routes,
    mode: "hash"
});

import {
    ValidationObserver,
    ValidationProvider,
    extend,
    localize
} from "vee-validate";
import lt from "vee-validate/dist/locale/lt.json";
import * as rules from "vee-validate/dist/rules";
// Install VeeValidate rules and localization
Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
});

localize("lt", lt);

// Install VeeValidate components globally
Vue.component("ValidationObserver", ValidationObserver);
Vue.component("ValidationProvider", ValidationProvider);

extend("password", {
    params: ["target"],
    validate(value, { target }) {
        return value === target;
    },
    message: "Slaptažodžiai nesutampa!"
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//--------------------------------------------
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component(
    "users-component",
    require("./components/admin/UserComponent.vue").default
);
Vue.component(
    "users-table",
    require("./components/users/TableComponent.vue").default
);
Vue.component(
    "create-button",
    require("./components/CreateButtonComponent.vue").default
);
Vue.component(
    "roles-table",
    require("./components/roles/TableComponent.vue").default
);
Vue.component(
    "products-table",
    require("./components/products/TableComponent.vue").default
);
Vue.component(
    "passport-clients",
    require("./components/passport/Clients.vue").default
);

Vue.component(
    "passport-authorized-clients",
    require("./components/passport/AuthorizedClients.vue").default
);

Vue.component(
    "passport-personal-access-tokens",
    require("./components/passport/PersonalAccessTokens.vue").default
);

Vue.component(
    "user-create",
    require("./components/users/CreateFormComponent.vue").default
);
Vue.component(
    "role-create",
    require("./components/roles/CreateFormComponent.vue").default
);
Vue.component(
    "product-create",
    require("./components/products/CreateFormComponent.vue").default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: "#app"
});
