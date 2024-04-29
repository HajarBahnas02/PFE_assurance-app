

<template>
    <div>   
    <Header/>
    <SousHeader/>
    <Menu/>
      <!-- Assurez-vous que la balise router-view est placée avant les autres éléments -->
    </div>
  </template>
  
  <script>
  import Header from '../views-home/Header.vue';
  import SousHeader from '../views-home/SousHeader.vue';
import Menu from '../views-home/Menu.vue';
  export default {
    name: 'Home',
    components: {
      Header,
      SousHeader,
      Menu,
    },
  }
  </script>
  