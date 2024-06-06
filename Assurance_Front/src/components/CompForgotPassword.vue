<!-- resources/js/components/ForgotPassword.vue -->
<template>
  <div>
<div>
  <Layout />
</div>
  <div class="cont-pass">
    <div class="forgot-password-container">
      <form @submit.prevent="sendResetLink">
        <h3>Mot de passe oublié</h3>
        <div class="form-group">
          <label for="email">Adresse email:</label>
          <input type="email" v-model="email" id="email" required />
        </div>
        <button type="submit">Envoyer le lien de réinitialisation</button>
        <div v-if="message" class="message">{{ message }}</div>
        <div v-if="error" class="error">{{ error }}</div>
      </form>
    </div>
  </div>
 </div>
</template>
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
      email: "",
      message: "",
      error: "",
    };
  },
  methods: {
    async sendResetLink() {
  this.message = "";
  this.error = "";

  // Afficher l'email dans la console avant l'envoi
  console.log("Email à envoyer:", this.email);

  try {
    const response = await axios.post("/forgot-password", {
      email: this.email,
    });
    
    if (response.status === 200) {
        this.message = response.data.message;
      } else {
        this.error = "Une erreur s'est produite. Veuillez réessayer.";
      } 
     } catch (error) {
    if (error.response && error.response.data) {
      this.error = error.response.data.message;
    } else {
      this.error = "Une erreur s'est produite. Veuillez réessayer.";
    }
  }
},

}
};
</script>

<style scoped>
.forgot-password-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 4px;
}
.form-group {
  margin-bottom: 1rem;
}
.form-group label {
  display: block;
  margin-bottom: 0.5rem;
}
.form-group input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}
button {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}
.message {
  margin-top: 1rem;
  color: green;
}
.error {
  margin-top: 1rem;
  color: red;
}
</style>

<style>
.forgot-password-container {
  width: 40%;
  height: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9; /* Couleur de fond différente */
}

.forgot-password-container form {
  width: 100%;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.form-group {
  margin-bottom: 10px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}



.form-group button {
  width: 100%;
  margin-top: 12px;
  padding: 10px;
  border: none;
  border-radius: 3px;
  background: linear-gradient(45deg, #298cc5, #f5f5f5);
  color: #fff;
  cursor: pointer;
}

.form-group button:hover {
  background-color: #0056b3;
}

.message {
  font-size: 14px;
  color: #007bff;
}

.error {
  font-size: 14px;
  color: red;
}
</style>

