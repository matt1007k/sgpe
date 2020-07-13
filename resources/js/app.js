/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import "alpinejs";
require("./bootstrap");

window.Vue = require("vue");

import "./plugins/simplemde";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("modal-left", require("./components/ModalLeft.vue").default);
Vue.component(
    "alert-floating",
    require("./components/AlertFloating.vue").default
);
Vue.component("btn-delete", require("./components/BtnDelete.vue").default);
Vue.component(
    "verify-user",
    require("./components/users/VerifyUser.vue").default
);
Vue.component(
    "btn-view-user",
    require("./components/users/BtnViewUser.vue").default
);
Vue.component(
    "dropdown-auth",
    require("./components/users/DropdownAuth.vue").default
);
Vue.component(
    "modal-generate",
    require("./components/users/ModalGenerate.vue").default
);

Vue.component(
    "dropdown-sort",
    require("./components/DropdownSort.vue").default
);
Vue.component(
    "sent-message",
    require("./components/inboxes/sentMessage.vue").default
);
Vue.component(
    "inboxes-index",
    require("./components/inboxes/Index.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    data() {
        return {
            open: false
        };
    }
});
