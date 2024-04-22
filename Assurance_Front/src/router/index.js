import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import About from '../components/About.vue';
import Ass_Auto_simulation from '../components/Ass_Auto_simulation.vue';
import Header from '../views-home/Header.vue';
import SousHeder from '../views-home/SousHeader.vue';
//import Footer from '../views-home/Footer.vue';
import Layout from '../views-home/Layout.vue';
const routes = [
  
//{path:'/', component: Layout,children:[
    { path: '/', component: Home },
  { path: '/about', component: About, name: 'about' },
  { path: '/Ass_Auto_simulation', component: Ass_Auto_simulation },
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
