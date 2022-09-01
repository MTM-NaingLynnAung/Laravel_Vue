import PostIndex from './components/posts/Index.vue'
import PostCreate from './components/posts/Create.vue'
import PostEdit from './components/posts/Edit.vue'

import UserIndex from './components/users/Index.vue'
import UserCreate from './components/users/Create.vue'
import UserEdit from './components/users/Edit.vue'

import Login from './components/auth/Login.vue'

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
  },
  {
    path: '/users',
    component: UserIndex,
    name: 'UserIndex',
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/users/create',
    component: UserCreate,
    name: 'UserCreate'
  },
  {
    path: '/users/edit/:id',
    component: UserEdit,
    name: 'UserEdit'
  },
  {
    path: '/login',
    component: Login,
    name: 'Login'
  }



];
