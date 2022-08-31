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
