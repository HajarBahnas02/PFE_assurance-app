import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import About from '../components/AboutCompo.vue';
import Recaptcha from '../components/Recaptcha.vue';

import SousHeder from '../views-home/SousHeader.vue';

//import Footer from '../views-home/Footer.vue';
const routes = [
  
//{path:'/', component: Layout,children:[
    { path: '/', component: Home },
  { path: '/about', component: About, name: 'about' },
  { path: '/Recaptcha', component: Recaptcha },
  { path: '/header', component: Home, name: 'header'},
  { path: '/sousheader', component: SousHeder },
  //{ path: '/footer', component: Footer }
];
//}];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
