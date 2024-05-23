<template>
  <div class="admin-comp">
    <Layout />
    <div class="log-admin">
      <div class="admin-panel">
        <img src="../assets/logo.png"
          style="width: 150px; padding:12%" alt="logo">
        <h4 class="">Shahed Assurance</h4>
        <div class="admin-frm">
       
          <form @submit.prevent="login">
            <div class="input-field">
              <input type="text" id="email" v-model="credentials.email" required>
              <label for="email">Emai:</label>
            </div>
            <span class="error-message">{{ error.email }}</span>

            <div class="input-field">
              <input type="password" id="password" v-model="credentials.password" required>
              <label for="password">Mot de passe:</label>
            </div>
            <span class="error-message">{{ error.password }}</span> <!-- Afficher les erreurs sous le champ -->
            <span class="error-message">{{ error.general }}</span>

            <button type="submit">Se connecter</button>
          </form>
        </div>
      </div>
      <div class="form-details">
        <h3 style=" padding-top:12%">Bienvenue de retour </h3>
        <p style="padding-top:0%">Veuillez vous connecter avec vos informations personnelles pour accéder à l'espace administrateur.</p>
    </div>
    </div>
   
  
  <Footer /></div>
 
</template>
<style scoped>
.admin-comp {
  display: flex;

  flex-direction: column;
  height: 100vh;
background-color: inherit;
}
.log-admin {
  display: flex;
  flex-wrap: wrap;
  wrap-direction: row;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color:rgb(232 233 234);
}
.text-center{
  
}
.admin-panel {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  wrap-direction: row;
  max-width: 330px;
  text-align: center;
  width: 100%;
height: 70%;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
background-color: rgb(145 204 237);

}
.form-details{
color: #fff;
max-width: 330px;
text-align: center;
width: 100%;
height: 70%;
display: flex;
flex-direction: column;
justify-content: center;
padding: 2%;
flex-wrap: wrap;
background-image: url('../assets/admin-paneau.jpg');
background-size: cover;
background-position: center;
}
.admin-frm{
  padding: 2%;
}
.input-adm {
  position: relative;
  border-bottom: 2px solid #ccc;
  background-color: aqua;
}
.input-adm label {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  color: black;
  font-size: 16px;
  pointer-events: none;
  transition: 0.15s ease;
  
}
.input-adm input {
  width: 100%;
  height: 40px;
  background: transparent;
  border: none;
  outline: none;
  font-size: 16px;
  color: #e21616;
  font: 400 13.3333px Arial;
  
}

.input-adm input:focus ~ label,
.input-adm input:valid ~ label {
  font-size: 0.8rem;
  top: 10px;
  transform: translateY(-120%);
}

.input-adm {
  position: relative;
  border-bottom: 2px solid #ccc;
}
.input-adm label {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  color: black;
  font-size: 16px;
  pointer-events: none;
  transition: 0.15s ease;
  background-color: blanchedalmond;
}
.input-adm input {
  width: 100%;
  height: 40px;
  background: transparent;
  border: none;
  outline: none;
  font-size: 16px;
  color: #171717;
  font: 400 13.3333px Arial;
  background-color: rgb(42, 56, 136);
  padding:12%;
  
}

.input-adm input:focus ~ label,
.input-adm input:valid ~ label {
  font-size: 0.8rem;
  top: 10px;
  transform: translateY(-120%);
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
      credentials: {
        email: '',
        password: ''
      },
      error: {
        email: '',
        password: '',
        general: ''
      } 
    };
  },
  methods: {
    async login() {
      // Vérifier si les champs obligatoires sont vides
      if (!this.credentials.email || !this.credentials.password) {
        this.error.general = 'Veuillez remplir tous les champs obligatoires.';
        return;
      }

      try {
        const response = await axios.post('/admin/login', this.credentials);
        // Gérer la réponse
        console.log(response.data);
        this.$router.push({ name: "espace-admin" });

      } catch (error) {
        // Gérer les erreurs
        this.error.email = error.response.data.errors.cin_not_exist || '';
        this.error.password = error.response.data.errors.wrong_password || '';
        this.error.general = 'Une erreur s\'est produite';
        console.error('Error:', error);
      }
    }
  }
}
</script>