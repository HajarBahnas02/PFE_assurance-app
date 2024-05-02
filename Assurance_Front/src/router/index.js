import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import About from '../components/AboutCompo.vue';
import assuranceAutoSimulation from '../components/assurance-auto-simulation.vue';
import Tarification from '../components/Tarification.vue';
import Recaptcha from '../components/Recaptcha.vue';


import SousHeader from '../views-home/SousHeader.vue';

const routes = [
  
//{path:'/', component: Layout,children:[
    { path: '/', component: Home },
  { path: '/about', component: About, name: 'about' },
  { path: '/Recaptcha', component: Recaptcha },
  { path: '/header', component: Home, name: 'header'},

  { path: '/sousheader', component: SousHeader },
  { path: '/footer', component: Home,name:'footer'},
  {path: '/tarification', component:Tarification, name: 'tarification' },
  { path: '/assuranceAutoSimulation', component: assuranceAutoSimulation, name: 'assuranceAutoSimulation' },

  //{ path: '/footer', component: Footer }
];
//}];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
