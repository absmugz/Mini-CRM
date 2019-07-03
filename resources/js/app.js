/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Home from './views/Home'
import Login from './views/Login'
import Register from './views/Register'
import UserBoard from './views/UserBoard'
import Admin from './views/Admin'
import SingleCompany from './views/SingleCompany'
import CreateCompanyComponent from './components/admin/CreateCompanyComponent'
import EditCompanyComponent from './components/admin/EditCompanyComponent'
import CreateUserComponent from './components/admin/CreateUserComponent'
import EditUserComponent from './components/admin/EditUserComponent'


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
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
        },,
        {
            path: '/companies/:id',
            name: 'single-company',
            component: SingleCompany
        },
        {
            path: '/dashboard/:page',
            name: 'dashboard-pages',
            component: UserBoard,
            meta: { 
                requiresAuth: true,
                is_user : true
            }
        },{
            path: '/dashboard',
            name: 'userboard',
            component: UserBoard,
            meta: { 
                requiresAuth: true,
                is_user : true
            }
        },,
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: { 
                requiresAuth: true,
                is_admin : true
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: { 
                requiresAuth: true,
                is_admin : true
            }
        }, {
            path: '/create-company',
            name: 'create-company',
            component: CreateCompanyComponent,
            meta: { 
                requiresAuth: true,
                is_admin : true
            }
        }, {
            path: '/edit-company/:id',
            name: 'edit-company',
            component: EditCompanyComponent,
            meta: { 
                requiresAuth: true,
                is_admin : true
            }
        },{
            path: '/create-user',
            name: 'create-user',
            component: CreateUserComponent,
            meta: { 
                requiresAuth: true,
                is_admin : true
            }
        },{
            path: '/edit-user/:id',
            name: 'edit-user',
            component: EditUserComponent,
            meta: { 
                requiresAuth: true,
                is_admin : true
            }
        }
    ],
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
      if (localStorage.getItem('jwt') == null) {
        next({
          path: '/login',
          params: { nextUrl: to.fullPath }
        })
      } else {
        let user = JSON.parse(localStorage.getItem('user'))
        if(to.matched.some(record => record.meta.is_admin)) {
          if(user.is_admin == 1){
              next()
          }
          else{
              next({ name: 'userboard'})
          }
        }
        else if(to.matched.some(record => record.meta.is_user)) {
          if(user.is_admin == 0){
              next()
          }
          else{
              next({ name: 'admin'})
          }
        }
        next()
      }
    } else {
      next() 
    }
  })
  
  const app = new Vue({
      el: '#app',
      components: { App },
      router,
  });