import { createApp } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import App from './App.vue';
import router from './router';
import 'primevue/resources/themes/aura-light-green/theme.css'
import PrimeVue from 'primevue/config';
import Button from "primevue/button"
import 'primevue/resources/primevue.min.css'

import $ from 'jquery';
import 'datatables.net';
//import 'datatables.net-dt/css/jquery.dataTables.css';
Vue.config.productionTip = false;



library.add(fas);

//import './index.css'
createApp(App).use(router)
  .component('fa', FontAwesomeIcon, 'Button', Button)
  .mount('#app')
  .use(PrimeVue);

new Vue({
  render: h => h(App),
}).$mount('#app');