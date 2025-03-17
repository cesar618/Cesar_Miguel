import { createRouter, createWebHistory } from 'vue-router';
import Actor from '@/views/actores/Actor.vue'; // Ruta corregida

const routes = [
  {
    path: '/actoresRuta',
    name: 'actores',
    component: Actor,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
