require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router'
import App from './components/App'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare,faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import store from './store';

Vue.use(VueRouter);
import Register from './components/register'
import Login from './components/login'
import Sidebar from './components/template/Sidebar'
import Student from './components/Student'
import Teacher from './components/Teacher'
import Chat from './Chat/container';
library.add(faPlusSquare,faTrash)

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('login-form', require('./components/loginForm.vue').default);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: '',
      component: Login
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/student',
      name: 'student',
      component :Student,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/teacher',
      name: 'teacher',
      component: Teacher,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/chat',
      name: 'chat',
      component: Chat,
    }
  ],
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (localStorage.getItem("token") == null) {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    } else {
      next({params: { nextUrl: to.fullPath }});
    }
  } else {
    next();
  }
});

new Vue({
  el: '#app',
  store,
  router,
  components: { App,Sidebar }
});