require('./bootstrap');

window.Vue = require('vue');
import Notifications from 'vue-notification';
import VueSweetalert2 from 'vue-sweetalert2';
import VuejsClipper from 'vuejs-clipper'
// install

import VueQrcode from '@chenfengyuan/vue-qrcode';

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.use(Notifications);
Vue.use(VuejsClipper);

Vue.component(VueQrcode.name, VueQrcode);
Vue.component('search-category', require('./components/SearchCategory.vue').default);
Vue.component('search-product', require('./components/SearchProduct.vue').default);
Vue.component('table-component', require('./components/Table').default);
Vue.component('image-crop', require('./components/ImageCrop').default);
Vue.component('dashboard-client', require('./components/DashboardClient').default);

const app = new Vue({
    el: '#app',
});
