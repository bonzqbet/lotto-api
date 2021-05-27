require('./bootstrap');

window.Vue = require('vue');

Vue.component('welcome', require('./components/lotteComponent.vue'));

const app = new Vue({
    el: '#app'
});