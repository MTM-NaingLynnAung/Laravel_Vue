// import TestComponent from './components/TestComponent.vue'
// import PostComponent from './components/PostComponent.vue'

// import Vue from 'vue';
// import VueRouter from 'vue-router';


// const router = new VueRouter({
//   mode: 'history',
//   routes: [
//     {
//       path: '/',
//       component: TestComponent,
//     },
  
//     {
//       path: '/vue/posts',
//       component: PostComponent,
//       name: 'posts',
//       beforeEnter: (to, from, next) => {
//        let auth = localStorage.getItem('auth');
//        if(auth){
//          next()
//        }else {
//         next('/')
//        }
        
//       }
//     }
//   ]
// });

// Vue.use(VueRouter)

// export default router;

import PostIndex from './components/posts/Index.vue'
import PostCreate from './components/posts/Create.vue'
import PostEdit from './components/posts/Edit.vue'

export const routes = [
  {
    path: '/posts',
    component: PostIndex,
    name: 'PostIndex'
  },
  {
    path: '/posts/create',
    component: PostCreate,
    name: 'PostCreate'
  },
  {
    path: '/posts/edit/:id',
    component: PostEdit,
    name: 'PostEdit'
  }

];
