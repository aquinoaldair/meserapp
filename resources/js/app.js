require('./bootstrap');

window.Vue = require('vue');
import Notifications from 'vue-notification';
import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.use(Notifications);


Vue.component('search-category', require('./components/SearchCategory.vue').default);
Vue.component('search-product', require('./components/SearchProduct.vue').default);

const app = new Vue({
    el: '#app',
});
