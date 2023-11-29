require('./bootstrap');
window.Vue = require('vue').default;
// Đăng ký component
Vue.component('product-component', require('./components/ProductComponent.vue').default);
Vue.component('category-component', require('./components/CategoryComponent.vue').default);

const app = new Vue({
    el: '#app',
});
