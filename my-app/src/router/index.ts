import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },

  {
    path: '/employee',
    name: 'employee',
    component: () => import('../views/EmployeeView.vue')
  },

  {
    path: '/project',
    name: 'project',
    component: () => import('../views/ProjectView.vue')
  },

  {
    path: '/task/:projectId',
    name: 'task',
    component: () => import('../views/TaskView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
