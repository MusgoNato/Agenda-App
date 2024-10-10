import { createWebHistory, createRouter } from 'vue-router'

import HomeView from '../views/LoginView.vue'

const routes = [
  { path: '/login/:toast?', component: HomeView },
]
const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;
