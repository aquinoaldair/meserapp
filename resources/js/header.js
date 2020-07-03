require('./bootstrap');

import Vue from 'vue/dist/vue.min.js';

// install
Vue.component('alert-table', require('./components/AlertTable').default);

const app = new Vue({
    el: '#header',
});
