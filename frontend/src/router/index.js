import { createRouter, createWebHistory } from 'vue-router'
const session = sessionStorage.getItem('user');
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue')
    },
    {
      path: '/mainview',
      name: 'MainView',
      component: () => import('../views/MainView.vue')
    }
  ]
})

router.beforeEach(async (to, from) => {
  if (to.name !== 'login' && to.name !== 'register' && !sessionStorage.getItem('userID')){
    return { name: 'login' }
  }
  if((to.name === 'login' || to.name === 'register') && sessionStorage.getItem('userID')){
    return { name: 'MainView' }
  }
});

export default router
