import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import PrimeVue from 'primevue/config';
import Button from "primevue/button";
import 'primevue/resources/themes/aura-light-green/theme.css';
import 'primevue/resources/primevue.min.css';
//import Toast from 'vue-toastification';
//import 'vue-toastification/dist/index.css';
import $ from 'jquery';
import 'datatables.net';

library.add(fas);

const app = createApp(App);

app.use(router);
app.use(PrimeVue);
//app.use(Toast);

app.component('fa', FontAwesomeIcon);
app.component('VueDatePicker', VueDatePicker);
app.component('Button', Button);

app.mount('#app');
