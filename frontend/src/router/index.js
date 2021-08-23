import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
  {
    path: '/login',
    name: 'LoginPage',
    component: () => import('../pages/LoginPage.vue'),
  },
  {
    path: '/register',
    name: 'RegisterPage',
    component: () => import('../pages/RegisterPage.vue'),
  },
  {
    path: '/',
    name: 'PostsPage',
    component: () => import('../pages/PostsPage.vue'),
  },
  {
    path: '/pending-posts',
    name: 'PendingPostsPage',
    component: () => import('../pages/PendingPostsPage.vue'),
  },
  {
    path: '/my-posts',
    name: 'MyPostsPage',
    component: () => import('../pages/MyPostsPage.vue'),
  },
  {
    path: '/post/:id',
    name: 'PostPage',
    component: () => import('../pages/PostPage.vue'),
  },
  {
    path: '/create-post',
    name: 'CreatePostPage',
    component: () => import('../pages/CreatePostPage.vue'),
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const publicPages = ['LoginPage', 'RegisterPage']
  const authRequired = !publicPages.includes(to.name)
  const loggedIn = localStorage.user

  if (authRequired && !loggedIn) {
      return next('/login')
  }

  next()
});

export default router
