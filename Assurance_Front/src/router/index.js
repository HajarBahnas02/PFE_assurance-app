import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import About from '../components/AboutCompo.vue';
import assuranceAutoSimulation from '../components/assurance-auto-simulation.vue';
import Tarification from '../components/Tarification.vue';
import CompLogin from '../components/CompLogin.vue';
import SousHeader from '../views-home/SousHeader.vue';
import CompEspaceClient from '@/components/CompEspaceClient.vue';
import CompForgotPassword from '@/components/CompForgotPassword.vue';
import CompAdminLogin from '@/components/CompAdminLogin.vue';
import CompEspaceAdmin from '@/components/CompEspaceAdmin.vue';

const routes = [
  
    { path: '/', component: Home },
  { path: '/about', component: About, name: 'about' },
  { path: '/header', component: Home, name: 'header'},
  { path: '/sousheader', component: SousHeader },
  { path: '/footer', component: Home,name:'footer'},
  {path: '/tarification', component:Tarification, name: 'tarification' },
  { path: '/assuranceAutoSimulation', component: assuranceAutoSimulation, name: 'assuranceAutoSimulation' },
  { path: '/login', component: CompLogin, name: 'login' },
  { path: '/espace-client', component: CompEspaceClient, name: 'espace-client' },
  { path: '/mot-de-passe-oublié', component: CompForgotPassword, name: 'mot-de-passe-oublié' },
  { path: '/login-admin', component: CompAdminLogin, name: 'login-admin' },
  { path: '/espace-admin', component: CompEspaceAdmin, name: 'espace-admin' }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
