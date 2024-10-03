import { createMemoryHistory, createRouter } from 'vue-router'

import HomeView from '../../views/HomeView.vue'
import TesteEvento from '../../views/TesteEvento.vue'

const routes = [
  { path: '/', component: TesteEvento },
  { path:'/evento',component:HomeView}
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})

export default router;
