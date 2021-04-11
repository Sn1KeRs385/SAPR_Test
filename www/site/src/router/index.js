import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
    {
    path: '/',
    name: 'Home',
    component: Home
    },
    {
        path: '/register',
        name: 'Register',
        component: () => import('../views/Register.vue')
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../views/Login.vue')
    },
    {
        path: '/logout',
        name: 'Logout',
        component: () => import('../views/Logout.vue')
    }
]

const router = new VueRouter({
  routes
})

router.beforeEach(
    (to, from, next) => {
        let token = localStorage.getItem('token')
        if(token !== null && token !== undefined && (to.fullPath === '/register' || to.fullPath === '/login')) {
            next({path: '/'});
        } else if((token === null || token === undefined) && to.fullPath !== '/register' && to.fullPath !== '/login'){
            next({path: '/register'});
        } else {
            next();
        }
    }
)

export default router
