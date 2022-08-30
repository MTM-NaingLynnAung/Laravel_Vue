// require('./bootstrap');

// window.Vue = require('vue').default;

// import router from './routes';
// import Swal from 'sweetalert2';

// Vue.component('post-component', require('./components/PostComponent.vue').default);
// Vue.component('test-component' ,require('./components/TestComponent.vue').default);

// window.Swal = Swal;

// const app = new Vue({
//     el: '#app',
//     router
// });


require('./bootstrap');
window.Vue = require('vue').default;


import VueRouter from 'vue-router';

Vue.use(VueRouter);


import App from './App.vue';
import { routes } from './routes';


const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
