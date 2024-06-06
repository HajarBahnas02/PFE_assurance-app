<template>
    <div>
      <h1>Définir votre mot de passe</h1>
      <form @submit.prevent="setPassword">
        <div>
          <label for="password">Mot de passe</label>
          <input type="password" id="password" v-model="password" required>
        </div>
        <div>
          <label for="password_confirmation">Confirmer le mot de passe</label>
          <input type="password" id="password_confirmation" v-model="password_confirmation" required>
        </div>
        <button type="submit">Définir le mot de passe</button>
      </form>
    </div>
  </template>
  
  <script>
import axios from "../router/axios-config.js";
  
  export default {
    data() {
      return {
        password: '',
        password_confirmation: '',
      };
    },
    methods: {
      async setPassword() {
        try {
          
            const clientId = this.$route.params.clientId;
            console.log(" client id : ", clientId);

            await axios.post(`/clients/set-password/${clientId}`, {
            password: this.password,
            password_confirmation: this.password_confirmation,
          });
         this.$router.push(`/espace-client/${clientId}`);
          console.log("mot de passe enregistrer")
        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>
  