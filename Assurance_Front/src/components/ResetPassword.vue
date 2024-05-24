<template> <Layout />
  <div class="cont-pass"> 
    <div class="reset-password-container">
      <h3>Réinitialisation de mot de passe</h3>
      <form @submit.prevent="resetPassword" class="reset-password-form">
        <div>
          <label for="password">Nouveau mot de passe:</label>
          <input type="password" id="password" v-model="password" required>
        </div>
        <div>
          <label for="password_confirmation">Confirmer le nouveau mot de passe:</label>
          <input type="password" id="password_confirmation" v-model="passwordConfirmation" required>
        </div> 
        <div v-if="message" class="message">{{ message }}</div>

        <!-- Utilisation de router-link pour naviguer vers la page /login -->
        <button type="submit">Réinitialiser le mot de passe</button>

      </form>
    </div>
  </div>
</template>

<style>
.cont-pass {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  cursor: default; 
  background-color: #298cc5;
}

.reset-password-container {
  width: 40%;
  height:auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}


.reset-password-form div {
  margin-bottom: 10px;
}

.reset-password-form label {
  display: block;
  margin-bottom: 5px;
}

.reset-password-form input[type="password"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.reset-password-form button {
  width: 100%;
  margin-top: 12px; /* Ajustement de la marge */
  padding: 10px;
  border: none;
  border-radius: 3px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

.reset-password-form button:hover {
  background-color: #0056b3;
}

.message {
  font-size: 14px;
  color: #007bff;
}
</style>


<script>
import axios from "../router/axios-config.js";

import Footer from "../views-home/Footer.vue";
import Layout from "../views-home/Layout.vue";
export default {
  name: "Login",
  components: {
    Footer,
    Layout,
  },
  data() {
    return {
      email: '', // Vous devez récupérer l'email depuis l'URL ou un autre moyen
      token: '', // Vous devez récupérer le token depuis l'URL ou un autre moyen
      password: '',
      passwordConfirmation: '',
      message: '',
    };
  },
  mounted() {
    // Extraire l'email et le token de l'URL
    const urlParams = new URLSearchParams(window.location.search);
    this.email = urlParams.get('email');
    this.token = this.$route.params.token; // Assurez-vous que votre route Vue inclut le token
  },
  methods: {
    resetPassword() {
      if (this.password !== this.passwordConfirmation) {
        this.message = "Les mots de passe ne correspondent pas.";
        return; // Arrêter l'exécution de la méthode
      }
      axios.post('/reset-password', {
        email: this.email,
        token: this.token,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
      })
      .then(response => {
        this.message = response.data.message;
        alert("Mot de passe réinitialisé avec succès.");
        this.$router.push('/login');
      })
      .catch(error => {
        this.message = error.response.data.message;
      });
    },
  },
};
</script>


