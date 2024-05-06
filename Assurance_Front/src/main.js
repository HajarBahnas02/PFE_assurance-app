import { createApp } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import {fas} from  '@fortawesome/free-solid-svg-icons';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import App from './App.vue';
import router from './router'; 

library.add(fas);

//import './index.css'
createApp(App).use(router)
.component('fa',FontAwesomeIcon)
.mount('#app');