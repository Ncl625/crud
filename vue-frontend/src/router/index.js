import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import StudentsViewVue from '@/views/Students/View.vue'
import CreateVue from '@/views/Students/Create.vue'
import EditVue from '@/views/Students/Edit.vue'
import SignupVue from '@/views/Signup.vue'
import LoginVue from '@/views/Login.vue'
import setAuthHeader from '@/utils/setAuthHeader'


// import studentCreate from '@views/Students/Create.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/students',
      name: 'students',
      component: StudentsViewVue,
      meta:{
        requiresAuth:true
      }
    },
    {
      path: '/student/create',
      name: 'studentCreate',
      component: CreateVue,
      meta:{
        requiresAuth:true
      }
    },
    {
      path: '/student/:id/edit',
      name: 'studentEdit',
      component: EditVue,
      meta:{
        requiresAuth:true
      }
    },
    {
      path: '/signup',
      name: 'signup',
      component: SignupVue,
      meta:{
        requiresAuth:false
      }
    },
    {
      path: '/login',
      name: 'login',
      component: LoginVue,
      meta:{
        requiresAuth:false
      }
    },
  ]
})
router.beforeEach((to, from) => {
  if (to.meta.requiresAuth && !localStorage.getItem('token')) {
    return { name : 'login'}
  }
  if (to.meta.requiresAuth == false && localStorage.getItem('token')) {
    return { name : 'students'}
  }
  if (to.meta.requiresAuth && localStorage.getItem('token')) {
    setAuthHeader(localStorage.getItem('token'))
  }
})

export default router
