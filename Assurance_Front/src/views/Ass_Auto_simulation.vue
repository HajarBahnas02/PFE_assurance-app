<template>
    <div>
      <h2>Type de motorisation</h2>
      <ul>
        <li v-for="type in typesMotorisation" :key="type.id">{{ type.typeMotorisation }}</li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        typesMotorisation: []
      };
    },
    mounted() {
      this.fetchTypesMotorisation();
    },
    methods: {
      async fetchTypesMotorisation() {
        try {
          const response = await axios.get('/api/type-motorisation');
          this.typesMotorisation = response.data;
        } catch (error) {
          console.error('Erreur lors de la récupération des types de motorisation :', error);
        }
      }
    }
  }
  </script>