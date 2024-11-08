import { createWebHistory, createRouter } from 'vue-router'

<<<<<<< HEAD
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import TokenView from '../views/VerificationView.vue'
import HomeView from '../views/HomeView.vue'
import serviceRoutes from './serviceRouter'

const routes = [
  {
    path: '/login/:toast?', name: 'login', component: LoginView,
    meta: {
      auth: false
    }
  },
  {
    path: '/register', name: 'register', component: RegisterView,
    meta: {
      auth: false
    }
  },
  {
    path: '/verification', name: 'verification', component: TokenView,
    meta: {
      auth: false
    }
  },
  {
    path: '/home',
    name: 'home',
    component: HomeView,
    meta: {
      auth: true
    }
  }
]

=======
import HomeView from '../views/LoginView.vue'

const routes = [
  { path: '/login/:toast?', component: HomeView },
]
>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
const router = createRouter({
  history: createWebHistory(),
  routes,
})

<<<<<<< HEAD
router.beforeEach(serviceRoutes);

=======
>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
export default router;
