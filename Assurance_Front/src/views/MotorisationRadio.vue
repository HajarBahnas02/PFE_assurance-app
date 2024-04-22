<!-- MotorisationRadio.vue -->
<template>
    <div>
      <label v-for="motorisation in motorisations" :key="motorisation.id">
        <input type="radio" v-model="selectedMotorisation" :value="motorisation.id">
        {{ motorisation.nomMotorisation }}
      </label>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        motorisations: [],
        selectedMotorisation: null
      };
    },
    mounted() {
      this.fetchMotorisations();
    },
    methods: {
      async fetchMotorisations() {
        try {
          const response = await axios.get('/api/motorisations');
          this.motorisations = response.data;
        } catch (error) {
          console.error('Erreur lors de la récupération des motorisations :', error);
        }
      }
    }
  }
  </script>
  