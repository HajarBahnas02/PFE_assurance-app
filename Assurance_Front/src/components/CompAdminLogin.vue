<template>
  <div>
    <h2>Authentification Administrateur</h2>
    <form @submit.prevent="login">
      <div>
        <label for="cin">CIN:</label>
        <input type="text" id="cin" v-model="credentials.cin" required>
      </div>
      <div>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" v-model="credentials.password" required>
      </div>
      <button type="submit">Se connecter</button>
    </form>
    <div v-if="error" class="error">{{ error }}</div>
  </div>
</template>

<script>
import axios from "../router/axios-config.js";

export default {
  data() {
    return {
      credentials: {
        cin: '',
        password: ''
      },
      error: ''
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/admin/login', this.credentials);
        // Gérer la réponse
        console.log(response.data);
        alert('Connecté en tant qu\'administrateur');
        // Rediriger ou afficher un message de succès
      } catch (error) {
        // Gérer les erreurs
        this.error = error.response.data.errors.wrong_password || error.response.data.errors.cin_not_exist || 'Une erreur s\'est produite';
        console.error('Error:', error);
      }
    }
  }
}
</script>

<style scoped>
/* Styles spécifiques au composant */
</style>
