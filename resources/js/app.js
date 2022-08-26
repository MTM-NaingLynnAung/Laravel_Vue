require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('post-component', require('./components/PostComponent.vue').default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);



const app = new Vue({
    el: '#app',
});
