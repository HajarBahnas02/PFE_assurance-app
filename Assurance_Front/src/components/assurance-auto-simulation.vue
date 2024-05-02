<template>
  <Header />
  <Layout />
  <div class="background">
    <form class="form-horizontal" @submit.prevent="submitForm" method="post">
      <h1 class="titre"> Quel est votre type de motorisation</h1>
      <div class="choixM">
      <div
      class="checkbox-wrapper"
      v-for="motorisation in motorisations"
      :key="motorisation.id">
        <input
          type="radio"
          :id="'motorisation_' + motorisation.id"
          :value="motorisation.id"
          v-model="selectedMotorisation" @change="optionTouched = true"
          required
        />
        <label  :for="'motorisation_' + motorisation.id">{{ motorisation.typeM }}</label>
      </div></div>
    

<div class="container">
      <div class="input-wrapper">
        <label for="puissFiscale">Puissance fiscale :</label>
        <select
          v-model="selectedPuissFiscale"
          class="form-control"
          id="puissFiscale"
          required
          @blur="valeurTouched = true"
        >
          <option value="" disabled selected>Choisissez une puissance fiscale</option>
          <option
            v-for="puissFiscal in puissFiscales"
            :key="puissFiscal.id"
            :value="puissFiscal.id"
          >
            {{ puissFiscal.PuissFiscale }}
          </option>
        </select>
        <div v-if="!selectedPuissFiscale && valeurTouched" class="error-message">
          Attention, veuillez sélectionner une puissance fiscale.
        </div>
      </div>
      <div class="input-wrapper">
        <label for="dateCirculation">Date de mise en Circulation</label>
        <input
          type="date"
          name="dateCirculation"
          v-model="dateCirculation"
          required
          @blur="valeurTouched = true"
          pattern="\d{4}-\d{2}-\d{2}"
        />
        <div v-if="!dateCirculation && valeurTouched" class="error-message">
          Attention, veuillez sélectionner une date de mise en circulation.
        </div>
      </div>

    </div>

<div class="container">
  <div class="input-wrapper">
    <label for="marque">Marque :</label>
    <select v-model="selectedMarque" class="form-control" id="marque"  @blur="valeurTouched = true" required>
      <option value="" disabled selected>Choisissez une marque</option>
      <option v-for="marque in marques" :key="marque.id" :value="marque.id">
        {{ marque.nomMarque }}
      </option>
    </select>
    <div v-if="!selectedMarque && valeurTouched" class="error-message">
      Attention, veuillez sélectionner une marque.
    </div>
  </div>
  
  <div class="input-wrapper">
    <label for="modele">Modèle :</label>
    <select v-model="selectedModele" class="form-control" id="modele" required @blur="valeurTouched = true">
      <option value="" disabled selected>Choisissez un model</option>
      <option v-for="modele in modeles" :key="modele.id" :value="modele.id">
        {{ modele.nomModele }}
      </option>
    </select>
    <div v-if="!selectedModele && valeurTouched" class="error-message">
      Attention, veuillez sélectionner un modèle.
    </div>
  </div>
</div>  
<h1 class="titre"> Quelle est la valeur de votre véhicule ?
</h1>

<div class="container">
      <div class="input-wrapper">
        <label for="exampleInputEmail1">Valeur à nouveau</label>
        <input
          v-model="valeurNouvelle"
          min="0"
          type="number"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          @blur="valeurTouched = true"
          placeholder="Enter le prix "
          required
        />
        <div v-show="valeurTouched && !valeurNouvelle" class="error-message">
          La valeur à neuf est sous-estimée .
        </div>
      </div>
      <div class="input-wrapper">
        <label for="">Valeur Vénale</label>
        <input
          v-model="valeurVenale"
          min="0"
          max="valeurNouvelle"
          type="number"
          class="form-control"
          id="Value"
          aria-describedby="valeurVenaleHelp"
          @blur="valeurTouched = true"
          placeholder="Enter valeur vénale"
          required>
          <div v-if="!valeurVenale && valeurTouched && valeurVenale > valeurNouvelle" class="error-message">
            Donnez une valeur pour le prix vénal.
          </div>
      </div>
    </div> 
     
  
      <div class="container">
      <div class="input-wrapper">
        <label for="dateNaissance">Date de naissance du conducteur :</label>
        <input
          type="date"
          @blur="valeurTouched = true"
          name="dateNaissance"
          v-model="dateNaissance"
          required
          pattern="\d{4}-\d{2}-\d{2}"
        />
        <div v-if="!dateNaissance && valeurTouched" class="error-message">
          L'âge du conducteur doit être supérieur ou égal à 16 ans
        </div>
      </div>

      <div class="input-wrapper">
        <label for="ville">Ville :</label>
        <select v-model="selectedVille" class="form-control" id="ville" required>
          <option value="" disabled selected>Choisissez une ville</option>
          <option v-for="ville in villes" :key="ville.id" :value="ville.id">
            {{ ville.nomVille }}
          </option>
        </select>
        <div v-if="!selectedVille && valeurTouched" class="error-message">
          Attention, veuillez sélectionner une ville.
        </div>
      </div>
    </div>
    <div>
        <label class="titre">Depuis quand avez-vous votre permis de conduire?</label>
        <div class="choixM">
          <div class="checkbox-wrapper">
            <input
              type="radio"
              id="moins_de_5_ans"
              name="experiencePermis"
              value="Moins de 5 ans"
              v-model="experiencePermis"
              @change="optionTouched = true"
              required
            />
            <label for="moins_de_5_ans">Moins de 5 ans</label>
          </div>
          <div class="checkbox-wrapper">
            <input
              type="radio"
              id="de_5_a_20_ans"
              name="experiencePermis"
              value="De 5 à 20 ans"
              v-model="experiencePermis"
              @change="optionTouched = true"
            />
            <label class="" for="de_5_a_20_ans">De 5 à 20 ans</label>
          </div>
          <div class="checkbox-wrapper">
            <input
              type="radio"
              id="plus_de_20_ans"
              name="experiencePermis"
              value="Plus de 20 ans"
              v-model="experiencePermis"
              @change="optionTouched = true"
            />
            <label for="plus_de_20_ans">Plus de 20 ans</label>
          </div>
        </div>
        <div v-if="!experiencePermis && optionTouched" class="error-message">
          Veuillez sélectionner une option.
      </div>
      </div>

      <!-- Acceptation des conditions générales -->
      <div class="checkbox-wrapper">
        <input type="checkbox" id="acceptTerms" required  @change="optionTouched = true" />
        <label for="acceptTerms"
          >J'accepte les conditions générales d'utilisation, notamment la mention relative
          à la protection des données personnelles.</label>
      </div>
      <!-- Bouton de soumission Tarificatio
        <router-link id="link"  to="/tarification">n </router-link>-->

      <button type="submit" style=" background-color:rgb(28, 29, 171);">Valider</button>
    </form>
    <div class="contact">
      <h5>Besoin d'aide ?</h5>
      <h6>Contactez nous du lundi au vendredi de 9h à 18h</h6>
      <button class="contact-button">
        <i class="fas fa-phone"></i>
        <h4>065035907</h4>
      </button>
      <button class="contact-button">
        <i class="fas fa-phone"></i>
        <h4>065035907</h4>
      </button>
    </div>
</div>
<div>
<Footer />
</div>
</template>
<style>
.contact-button {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgb(28, 29, 171);
  color: white;
  border: none;
  border-radius: 5px;
width: 80%;  
  margin-top: 10px;
}
.contact h5{
  color: black;
  font-size: 20px;
}

.contact {
  width: 18%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: #D1E8FF;
  height: max-content;
  margin: 2%;
  padding: 2%;
}
.choixM {
  display: flex;
  justify-content: start;
   width: 100%;
   flex-wrap: wrap; 
}
.checkbox-wrapper{
  display: flex;
  margin-right: 1%;
  margin-top: 1%;
  border:none !important;
}
.checkbox-wrapper label{
  background-color: inherit;
  margin-left: 2%;
}
  .choixM input[type="radio"] {
    margin: 0px;
    margin-right:6px ;
    padding: 0px;
    
}
  .choixM label {
    font-size: 15px;
   
    font-family:Georgia, 'Times New Roman', Times, serif;
    background-color: inherit !important;
  }
  .input-wrapper {
    width: 50%; 
    margin-top: 1%;
    display: flex;
    flex-direction: column; 
  }
  .input-wrapper label {
    color: #0d0d0d;
    font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif; /* Espacement entre le label et la select */
  }
  .input-wrapper select {
    color: #0d0d0d;
    width:90%;
    font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif; /* Espacement entre le label et la select */
  }
  .input-wrapper input {
    color: #0d0d0d;
    width:90%;
    font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif; /* Espacement entre le label et la select */
  }
.checkbox-wrapper label{
  color: #0d0d0d;
  margin: 0px;
}
.background {
  display: flex;
  background-color: white;
  background-image: url('..\assets\Assurance_auto_chapo.avif'); /* Spécifiez le chemin de votre image */
   /* Assurez-vous que l'image couvre toute la zone */
  background-position:center;
  width: 100%; 
}


.titre {
  font-size: 20px;
  font-weight: bold;
  color: rgb(3, 28, 54);
  margin-left: 2%;
}
.container{
  display: flex;
}
.content {
  display: flex;
  height: max-content;
  border: 5px solid #ccc;
  margin: 2%;
  border-radius: 5px;
  width: 100%;
}
.form-horizontal {
  
   margin-left: 15%;
   border-radius: 5px;
   background-color: #D1E8FF;
   margin-top: 1%;
   margin-bottom: 1%;
  }
#acceptTerms {
  margin-left: 1%;
}

  

</style>

<script>
import Footer from "../views-home/Footer.vue";
import Layout from "../views-home/Layout.vue";
import axios from "../router/axios-config.js";
import { fas } from "@fortawesome/free-solid-svg-icons";
import '@fortawesome/fontawesome-free/css/all.css'


//import VueRecaptcha from 'vue-recaptcha'

//Vue.component('vue-recaptcha', VueRecaptcha)

export default {
  components: {
    Layout,
    Footer
  },
  data() {
    return {
        optionTouched: false,
      valeurTouched: false,
      valeurNouvelle: "",
      selectedPuissFiscale: "",
      experiencePermis: "",
      villes: [],
      dateCirculation: "",
      valeurVenale: "",
      valeurTouched: false,
      puissancesFiscale: [],
      selectedVille: "",
      marques: [],
      selectedMarque: "",
      selectedModele: "",
     
      selectedMotorisation: "",
     // selectedMotorisations: [],
      submitted: false,
      motorisations: [],
      puissanceFiscale: "",
      submitted: false,
      errors: {},
      value: "",
      formatted: "",
      selected: "",
    };
  },
  mounted() {
    axios
      .get("/Typem")
      .then((response) => {
        this.motorisations = response.data;
        console.log(this.motorisations);
      })
      .catch((error) => {
        console.error("Erreur lors du chargement des motorisations:", error);
      });
    axios.get("/Marques").then((response) => {
      this.marques = response.data;
      console.log(this.marques); // Vérifie que les données sont correctement récupérées
    });
    axios
      .get("/Modele")
      .then((response) => {
        this.modeles = response.data;
        console.log(this.modeles); // Vérifie que les données sont correctement récupérées
      })
      .catch((error) => {
        console.error("Une erreur est survenue : ", error);
      });
    axios.get("/Villes").then((response) => {
      this.villes = response.data;
      console.log(this.villes); // Vérifie que les données sont correctement récupérées
    });
    axios
      .get("/PuissanceFiscale")
      .then((response) => {
        // Succès de la requête : mettre à jour le tableau puissFiscales avec les données reçues
        this.puissFiscales = response.data;
      })
      .catch((error) => {
        // Erreur lors de la requête : afficher un message d'erreur dans la console
        console.error("Erreur lors de la récupération des données de l'API :", error);
      });
  },
  methods: {
    submitForm() {
      const formData = {
        motorisationId: this.selectedMotorisation,
        puissanceFiscale: this.selectedPuissFiscale,
        valeurNouvelle: this.valeurNouvelle,
        valeurVenale: this.valeurVenale,
        marqueId: this.selectedMarque,
        modeleId: this.selectedModele,
        dateCirculation: this.dateCirculation,
        villeId: this.selectedVille,
        experiencePermis: this.experiencePermis,
        matricule: "matricule",
      };
      console.log("Formulaire soumis avec les données suivantes :", formData);
      axios
        .post("/vehicules", formData)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          // Gérer les erreurs si nécessaire
          console.error("Erreur lors de l'envoi des données :", error);
        });
    },
  },
};
</script>

<style>

.error-message {
  color: red;
  font-size: 14px;
  display: flex;
}
input:invalid + .error-message {
  display: flex; /* Affiche le message d'erreur lorsque l'input est invalide */
}
.test {
  display: flex;
  flex-direction: column;
}
</style>
