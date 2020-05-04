window._ = require('lodash');
window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Reqiuested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token não encontrado: https://laravel.com/docs/csrf-x-csrf-token');
}
import VueSwal from 'vue-swal';
Vue.use(VueSwal);
Vue.component('product-detail', require('./components/ProductDetail.vue').default);
const app = new Vue({
    el: '#site',
    created: function () {
        console.log('Site Carregado');
    }
});
