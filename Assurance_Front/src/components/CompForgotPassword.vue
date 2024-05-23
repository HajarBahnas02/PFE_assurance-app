<template>  <Layout />

  <div class="forgot-password-container">
    <h2>Mot de passe oublié</h2>
    <form @submit.prevent="forgotPassword" class="forgot-password-form">
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required>
      </div>
      <button type="submit">Envoyer</button>
    </form>
    <div v-if="message" class="message">{{ message }}</div>
  </div>
  <Footer />
</template>

<style>
.forgot-password-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

.forgot-password-form {
  width: 300px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.forgot-password-form div {
  margin-bottom: 10px;
}

.forgot-password-form label {
  display: block;
  margin-bottom: 5px;
}

.forgot-password-form input[type="email"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.forgot-password-form button {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 3px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

.forgot-password-form button:hover {
  background-color: #0056b3;
}

.message {
  margin-top: 10px;
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
      email: '',
      message: '',
    };
  },
  methods: {
    forgotPassword() {
      axios.post('/forgot-password', {
        email: this.email,
        reset_url: 'http://localhost:5173/reset-password/' // Lien de la page reset-password

      })
      .then(response => {
        this.message = response.data.message;
      })
      .catch(error => {
        this.message = error.response.data.message;
      });
    }
  }
}
</script>

<style>
/* Styles CSS */
</style>
