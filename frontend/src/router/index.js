import { createRouter, createWebHistory } from 'vue-router'
import TasksView from '../views/TasksView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: TasksView,
    }
  ],
})

export default router
