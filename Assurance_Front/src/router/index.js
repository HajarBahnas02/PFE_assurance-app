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
import Modal from '@/components/Modal.vue';
import CompDevis from '@/components/CompDevis.vue';
import Dashboard from '@/components/Dashboard.vue';
import CompTarification from '../components/CompTarification.vue';
import ResetPassword from '@/components/ResetPassword.vue';
import CompSetPassword from '@/components/CompSetPassword.vue';
//import Tarification from '../components/Tarification.vue';

const routes = [

  { path: '/', component: Home },
  { path: '/about', component: About, name: 'about' },
  { path: '/header', component: Home, name: 'header' },
  { path: '/sousheader', component: SousHeader },
  { path: '/footer', component: Home, name: 'footer' },
  { path: '/sidebar', component: About, name: 'sidebar' },
  { path: '/assuranceAutoSimulation', component: assuranceAutoSimulation, name: 'assuranceAutoSimulation' },
  { path: '/login', component: CompLogin, name: 'login' },
  //{ path: '/espace-client', component: CompEspaceClient, name: 'espace-client',meta: { requiresAuth: true }  },
  { path: '/espace-client/:clientId', component: CompEspaceClient, name: 'espace-client', props:true},//meta: { requiresAuth: true }//  },

  { path: '/mot-de-passe-oublié', component: CompForgotPassword, name: 'mot-de-passe-oublié' },
  { path: '/login-admin', component: CompAdminLogin, name: 'login-admin' },
  { path: '/espace-admin', component: CompEspaceAdmin, name: 'espace-admin' },
  { path: '/modal', component: Modal, name: 'modal' },
  { path: '/devis', component: CompDevis, name: 'devis' },
  { path: '/dashboard', component: Dashboard, name: 'dashboard' },
  { path: '/tarifications/:clientId/dev:devisId', component: CompTarification, name: 'tarification', props: true, },
  {
    path: '/reset-password/:token', name: 'ResetPassword', component: ResetPassword, props: true
  },
  
    { path: '/set-password/:clientId', component: CompSetPassword,props:true}, // Ajouter la route pour la page d'enregistrement du mot de passe
  

];

const router = createRouter({
  history: createWebHistory(),
  routes
});
/*router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Vérifie si l'utilisateur est authentifié, par exemple en vérifiant la présence du token d'authentification dans le stockage local
    if (!localStorage.getItem('auth_token')) {
      // Redirige l'utilisateur vers la page de connexion s'il n'est pas authentifié
      next('/login')
    } else {
      // Autorise l'accès à la route
      next()
    }
  } else {
    // Si la route ne nécessite pas d'authentification, autorise simplement l'accès
    next()
  }
})*/

export default router;
