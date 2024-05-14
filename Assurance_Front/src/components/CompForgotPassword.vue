<template>
    <div>
      <h2>Mot de passe oublié</h2>
      <form @submit.prevent="submitForm">
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required>
        </div>
        <button type="submit">Envoyer</button>
      </form>
      <div v-if="message">{{ message }}</div>
    </div>
  </template>
  
  <script>
import axios from "../router/axios-config.js";
  
  export default {
    data() {
      return {
        email: '',
        message: ''
      };
    },
    methods: {
      submitForm() {
        axios.post("client/password/email", { email: this.email })
          .then(response => {
            this.message = response.data.message;
   
        })
          .catch(error => {
            console.error(error);
            // Gérer les erreurs, par exemple afficher un message d'erreur à l'utilisateur
          });
      }
    }
  };
  </script>
  
  <style scoped>
  /* Ajoutez vos styles CSS ici */
  </style>
  