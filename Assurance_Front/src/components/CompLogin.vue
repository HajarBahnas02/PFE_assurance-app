<template>
  <div class="logbackground">
  <div class="hdimargin">
  <Layout />
    <div class="discolum">
      <div class="content-login">
        <div class="titres">
          <h2 align="center">Bienvenue sur votre nouvel espace client</h2></div>
          <div class="logicons">
            <div class="item">
              <img src="../assets/home-login.svg" alt="Auto-icon"/>
              <h4>Auto</h4>
            </div>
            <div class="item">
              <img src="../assets/home-login.svg" alt="Habitation-icon" />
              <h4>Habitation</h4>
            </div>
            <div class="item">
              <img src="../assets/umbrella.svg" alt="Epargne-icon" />
              <h4>Epargne</h4>
            </div>
            <div class="item">
              <img src="../assets/medical-app.svg" alt="Santé-icon" />
              <h4>Santé</h4>
          </div>
        </div>
        <div class="consignes">
          <div class="consigne">
            <img src="../assets/to-do-list.svg" alt="Auto-icon" />
            <h4>Suivez vos dossiers</h4>
          </div>
          <div class="consigne">
            <img src="../assets/medical-app.svg" alt="Habitation-icon" />
            <h4>Consultez votre adhésion et vos prestations</h4>
          </div>
          <div class="consigne">
            <img src="../assets/order.svg" alt="Epargne-icon" />
            <h4>Déclarez un sinistre</h4>
          </div>
          <div class="consigne">
            <img src="../assets/conversation.svg" alt="Santé-icon" />
            <h4>Contactez votre service client</h4>
          </div>
          </div>
      </div>
      <div class="frm">
     <div class="form-log">
          <form @submit.prevent="loginData">
            <h2 align="center">Se connecter</h2>
            <div class="input-field">
              <input type="text" v-model="client.email" required /> 
              <label>Login</label>
            </div>
            <span v-if="submitted && !client.email" class="error-message">Champ obligatoire à insérer</span>
            <span v-if="errors.email_not_exist" class="error-message">{{ errors.email_not_exist }}</span>
            <div class="input-field">
              <input type="password" v-model="client.password" required />
              <label>Mot de passe</label> 
            </div>
            <span v-if="submitted && !client.password" class="error-message">Champ obligatoire à insérer</span>
            <span v-if="errors.wrong_password" class="error-message">{{ errors.wrong_password }}</span>   
            
            <div class="forget">
              <p class="forgot-password text-right">
                <router-link to="/mot-de-passe-oublié">
                Forgot password?</router-link></p>
            </div>
            <button :disabled="loading" type="submit">
              {{ loading ? "En cours de connexion" : "Se connecter" }}
            </button>
          </form>
        </div>
      </div>
      <div class="containerHelp">
        <span class="close-btn" @click="toggleMenu">
          <i class="fas fa-times"></i>
        </span>
        <div class="media-icons">
          <a href="#" style="background: #0e76a8">
            <i class="fas fa-question-circle"></i>
                        <span class="tooltip" style="color: #0e76a8">Question fréquentes</span>
          </a>
          <a href="#" style="background: #ff0000">
            <i class="fa-solid fa-location-dot"></i>
            <span class="tooltip" style="color: #ff0000">Localiser agence</span>
          </a>
          <a href="#" style="background: #ea4689">
            <i class="fa fa-address-book"></i>
            <span class="tooltip" style="color: #ea4689">Contacts utiles</span>
          </a>
          <a href="#" style="background: #8e36ff">
            <i class="fa-solid fa-phone"></i>
                        <span class="tooltip" style="color: #8e36ff">Contacter nous</span>
          </a>
        </div>
      </div>
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
      loading: false,
      client: {
        email: "",
        password: "",
      },
      remember: false, // Nouvelle propriété pour Se souvenir de moi
      submitted: false,
      errors: {},
    };
  },
  methods: {
    loginData() {
      this.submitted = true;
      this.loading = true;

      axios.post('/client/login', this.client)
        .then(({ data }) => {
          if (data.status === true) {
            this.$router.push('/espace-client');
            localStorage.setItem('auth_token', data.token);
          } else {
            // Réinitialiser les erreurs
            this.errors = data.errors || {};
            this.resetForm();

          }
        })
        .catch(error => {
          // Vérifier si l'erreur est due à une authentification échouée
          if (error.response && error.response.status === 400) {
            this.errors = error.response.data.errors || {};
          } else {
            console.error("Erreur de connexion:", error);
            alert("Une erreur s'est produite, veuillez réessayer.");
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },
    resetForm() {
      this.client.email = "";
      this.client.password = "";
    },
    toggleMenu() {
      const closeBtn = document.querySelector(".close-btn");
      closeBtn.classList.toggle("open");
    },
  },
};
</script>
<style>
.error-message {
  color:red;
  padding-bottom: 15px;
}
  .logbackground {
 background-image: url("../assets/login_background.jpg");
 width: 100%;
 height: 100vh;
 background-size: cover;
 background-position: center;
 background-repeat: no-repeat;
 justify-content: center;
  }
.hdimage {
  background-color: bisque;
  display: flex;
  justify-content: center;
}
.discolum{
  display: flex;
  flex-direction: column; /* Disposition en colonne pour les écrans de taille réduite */
  width: 100%;
}
@media screen and (min-width: 768px) {
  .discolum {
    flex-direction: row; /* Disposition en ligne pour les écrans de taille moyenne et grande */
  }
}
.content-login, .frm {
  flex: 1; 
}
.content-login {
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin: 0 !important;
  padding-top: 2%  !important;
  padding-bottom: 3%  !important;
}

.frm {
}
.content-loginn .titre h2 {
  color: #630606;
  font-family: Roboto;
  font-weight: 400;
}
.content-login .logicons {
    display: flex;
    flex-wrap:wrap;
    cursor: text;
    justify-content: space-between;
    margin:5%  10% 0% !important;
  }

.item {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.item img {
  width: 50px;
  height: 48px;
}
.logicons .item h4 {
  color: black;
  margin-top: 12px;
  font-size: 16px;
}
.item {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex-wrap: wrap;
}
.item img {
  width: 50px;
  height: 48px;
}
.consignes {
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-top: 5%;
  margin-left: 10% !important;
}
.consigne {
  display: flex;
  align-items: center;
  margin-top: 4%;
}
.consigne h4 {
  font-size: 16px;
  margin: 0;
}
.consigne img,
svg {
  margin-right: 3%;
  width: 40px;
  height: 40px;
}
.content-login {
  display: flex;
  flex-direction: column;
  padding-top: 13%;
  justify-content: start;
 
}
.content-login .titres h2 {
  color: #630606;
}
.wrapper {
  width: 25%;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(8px); 
}
.form-log {
  width: 60%;
  height: 75%;
  margin-top: 8%;
  margin-left: 30%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.5);
  background-color: rgba(255, 255, 255, 0.5); /* Couleur de fond avec transparence */
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(8px); 
}
.frm form {
  width: 80%;
  display: flex;
  flex-direction: column;

}
form h2 {
  font-size: 2rem;
  margin-bottom: 30px;
  color: rgb(0, 0, 0);
  font-family: "Poppins";
}
.input-field {
  position: relative;
  border-bottom: 2px solid #ccc;
  margin-bottom: 20px;
}
.input-field label {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  color: black;
  font-size: 16px;
  pointer-events: none;
  transition: 0.15s ease;
}
.input-field input {
  width: 100%;
  height: 40px;
  background: transparent;
  border: none;
  outline: none;
  font-size: 16px;
  color: #461cc6;
  font:  13.3333px ;
  
}

.input-field input:focus ~ label,
.input-field input:valid ~ label {
  font-size: 0.8rem;
  top: 10px;
  transform: translateY(-120%);
  font-weight: 600;
}
.forget {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 25px 0 35px 0;
}
.forget label p {
  margin-left: 8px;
}
.forget a {
  color: #fff;
}
.form-log a {
  color: black;
  text-decoration: none;
}

.form a:hover {
  text-decoration: underline;
}
button {
  background: #fff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}
button:hover {
  color: #fff;
  border-color: #fff;
  background: rgba(255, 255, 255, 0.15);
}
.containerHelp {
  position: fixed;
  height: 100%;
  left: 91%;
  bottom: 15%;
  display: flex;
  flex-direction: column-reverse;
}

.media-icons {
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  justify-content: center;
  background-color: inherit;
  padding: 6px;
  border-radius: 6px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  transform: translateX(300%);
  transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.close-btn.open ~ .media-icons {
  transform: translateX(0);
}
.media-icons a {
  text-decoration: none;
  position: relative;
  height: 35px;
  width: 35px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  margin: 6px;
}
.media-icons a .tooltip {
  position: absolute;
  left: calc(100% + 10px);
  font-size: 12px;
  font-weight: 400;
  pointer-events: none;
  background-color: #fff;
  padding: 4px 8px;
  border-radius: 4px;
  transform: translateY(-50%); /* Aligné verticalement au centre */
  opacity: 0;
  transition: all 0.2s linear;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
}

a:hover .tooltip {
  opacity: 1;
  transform: translateX(10px); /* Décalage à droite pour l'effet d'apparition */
}

a .tooltip::before {
  content: "";
  position: absolute;
  height: 10px;
  width: 10px;
  top: 50%;
  left: -5px;
  transform: translateY(-50%) rotate(45deg); /* Rotation ajustée */
  background-color: #fff;
}
.close-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 50px;
  width: 50px;
  border-radius: 50%;
  color: #1a7191;
  font-size: 18px;
  margin-top: 20px;
  background-color: #ffffff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transform: rotate(45deg);
  transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.close-btn.open {
  transform: rotate(0deg);
  background-color: #de0611;
}
button {
  background: #fff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}
button:hover {
  color: #fff;
  border-color: #fff;
  background: rgba(255, 255, 255, 0.15);
}


</style>
