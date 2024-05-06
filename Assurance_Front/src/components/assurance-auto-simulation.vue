<template>
  <Layout />
  <div class="background">
    <div class="title"><h1>Obtenez votre devis d’assurance auto en 3 minutes</h1></div>

    <div class="content">  
      <div class="contact">
        <div class="d-flex align-items-center mb-3">
          <img src="../assets/logo.svg" width="30%" height="30%" alt="assurance_auto" style="padding-right:10px; margin-left:23px">
          <span class="title" style="font-weight: 700; align-items:center;font-size: 16px; line-height: 28px;">Assurance voiture</span>
        </div>
        <ul class="listes" style="margin-left:12px;border:3px solid #ccc; padding:12px;">
          <li class="d-flex align-items-center">
            <img src="../assets/circle-check.svg" alt="logo" class="mr-3" style="margin-right:10px">
            <h5 class="m-0 ml-3" style="line-height: 18px; font-size: 13px;">Toutes les offres en un coup d'œil</h5>
          </li>
          <li class="d-flex align-items-center mt-3">
            <img src="../assets/circle-check.svg" alt="logo" class="mr-3"  style="margin-right:10px">
            <h5 class="m-0 mr-3" style="line-height: 18px; font-size: 13px;">Enregistrer vos données dans votre compte client</h5>
          </li>
        </ul>
      </div>
    
  

      <form class="form-horizontal" @submit.prevent="submitForm" method="post">
        <h1 class="titres">Quel est votre type de motorisation</h1>
        <div class="choixM">
          <div
            class="checkbox-wrapper"
            v-for="motorisation in motorisations"
            :key="motorisation.id"
          >
            <input
              type="radio"
              :id="'motorisation_' + motorisation.id"
              :value="motorisation.id"
              v-model="selectedMotorisation"
              @change="optionTouched = true"
              required
            />
            <label :for="'motorisation_' + motorisation.id">{{motorisation.typeM}}</label>
          </div>
        </div>

        <div class="container">
         
          <div class="input-wrapper">
            <label for="puissFiscale" class="titre">Puissance fiscale :</label>
            <select
              v-model="selectedPuissFiscale"
              class="form-control custom-select"
              id="puissFiscale"
              required
              @blur="valeurTouched = true"
            >
              <option value="" disabled selected>Choisissez une puissance fiscale</option>
              <option
                v-for="puissFiscal in puissFiscales"
                :key="puissFiscal.id"
                :value="puissFiscal.id"
                class="custom-option"
              >
                {{ puissFiscal.PuissFiscale }}
              </option>
            </select>
            <div v-if="!selectedPuissFiscale && valeurTouched" class="error-message">
              Attention, veuillez sélectionner une puissance fiscale.
            </div>
          </div>
          <div class="input-wrapper">
            <label for="dateCirculation" class="titre">Date de mise en Circulation</label>
            <input
              @blur="valeurTouched = true"
              type="date"
              class="form-control"
              v-model="dateCirculation"
              :max="maxDate"
            />
            <datepicker id="event-date" v-model="eventDate"></datepicker>

            <div v-if="!dateCirculation && valeurTouched" class="error-message">
              Attention, veuillez sélectionner une date de mise en circulation.
            </div>
          </div>
        </div>
        <VueDatePicker v-model="date" />

        <div class="container">
          <div class="input-wrapper">
            <label for="marque" class="titre">Marque :</label>
            <select
              v-model="selectedMarque"
              class="form-control"
              id="marque"
              @blur="valeurTouched = true"
              required
            >
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
            <label for="modele" class="titre">Modèle :</label>
            <select
              v-model="selectedModele"
              class="form-control"
              id="modele"
              required
              @blur="valeurTouched = true"
            >
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
        <h1 class="titres">Quelle est la valeur de votre véhicule ?</h1>

        <div class="container">
          <div class="input-wrapper" style="width:50%;">
            <label for="" class="titre " >Valeur à nouveau</label>
            <div class="input-group mb-3">
              <input type="number"  class="form-control"  v-model="valeurNouvelle"
               min="0"
              @blur="valeurTouched = true"
              placeholder="Enter le prix "
              required/>
              <span class="input-group-text"
                >DH
                <i
                  class="fas fa-info-circle"
                  data-bs-toggle="tooltip"
                  title="Explication de la valeur DH"
                ></i
              ></span>
            </div>
            <p v-if="valeurVenale > valeurNouvelle" style="color: red">
              La valeur vénale doit être inférieure ou égale à la valeur du véhicule
            </p>
          </div>
          <div class="input-wrapper" style="width:50%">
            <label for="" class="titre">Valeur Vénale</label>
            <div class="input-group mb-3">

            <input
              v-model="valeurVenale"
              min="0"
              :max="valeurNouvelle"
              type="number"
              class="form-control"
              id="Value"
              aria-describedby="valeurVenaleHelp"
              @blur="valeurTouched = true"
              placeholder="Enter valeur vénale"
              required
            />
            <span class="input-group-text"
                >DH
                <i
                  class="fas fa-info-circle"
                  data-bs-toggle="tooltip"
                  title="Explication de la valeur DH"
                ></i
              ></span>
            </div>
            <p v-if="valeurVenale > valeurNouvelle" style="color: red">
              La valeur vénale doit être inférieure ou égale à la valeur du véhicule
            </p>    
        </div>
        </div>
        <div class="container">
          <div class="input-wrapper">
            <label for="dateNaissance" class="titre">Date de naissance du conducteur :</label>
            <input
              @blur="valeurTouched = true"
              type="date"
              class="form-control"
              v-model="dateNaissance"
              :max="maxDateOfBirth"
            />
            <datepicker id="event-date" v-model="eventDate"></datepicker>

            <div v-if="!dateNaissance && valeurTouched" class="error-message">
              L'âge du conducteur doit être supérieur ou égal à 16 ans
            </div>
          </div>

          <div class="input-wrapper">
            <label for="ville" class="titre" >Ville :</label>
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
          <h1 class="titres">Depuis quand avez-vous votre permis de conduire?</h1>
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
        <div class="accept_terms">
          <input
            type="checkbox"
            id="acceptTerms"
            required
            @change="optionTouched = true" style="margin-left: 10px; margin-right: 10px; "
          />
          <label for="acceptTerms"
            >J'accepte les conditions générales d'utilisation, notamment la mention
            relative à la protection des données personnelles.</label
          >
        </div>
        <!-- Bouton de soumission Tarificatio
        <router-link id="link"  to="/tarification">n </router-link>-->
        <button type="submit" style="background-color: rgb(28, 29, 171)">Valider</button>
      </form>
      <div class="contact">
        <h5 class="title">Besoin d'aide ?</h5>
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
  </div>
  <div>
    <Footer />
  </div>
</template>X
<style>
.content{
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin:0 !important;
  height: 100vh;
}


.title{
  color:#298cc5 !important;
}

.form-horizontal {
  margin-left: 5%;
  border-radius: 5px;
  margin-top: 1%;
  margin-bottom: 1%;
  width: 60%;
  background-color: rgb(255 255 255);
  border: 3px solid #ccc;
}
.titres {
  font-size: 18px;
  margin-left:10px ;
  flex: 1 1 auto;
  color: rgb(51, 51, 51);
  margin-top: 20px;
}  
input[type="number"]:hover,
input[type="date"]:hover,


textarea:hover {
  border-color: #298cc5; /* Couleur de la bordure au survol */
}
select:hover {
  border-color: #298cc5;
}
.titre {
  display: flex;
  justify-content: center;
  color: #000;
  position: inherit;
  font-size: 14px;
  transform: translateY(-2px);
  font-weight: 600;
  display: inline-block; 
  margin-left: 10px;
}
.choixM{
  display: flex;
  width: 90%;
  flex-wrap: wrap;
  padding: 4px;
  margin-left: 2%;
  border-radius: 2%;
  justify-content: space-between;
  
}
.checkbox-wrapper {
  display: flex;
  background-color: #dbdbdb;
  border: 2px !important;
  border-radius: 10px;
  margin-right: 10px;
  padding: 10px;
 
}
.content {
  display: flex;
}
.container{
  display: flex;
  margin:0;
  padding:10px;
  
}
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
.contact h5 {
  color: black;
  font-size: 20px;
}

.contact {
  width: 18%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  height: max-content;
  margin: 2%;
  background-color:rgb(255 255 255);
  margin-bottom: 20%;
}


.checkbox-wrapper label {
  background-color: inherit;
  margin-left: 1%;
  width: 70%;
  text-align: center;
}
.choixM input[type="radio"] {
  margin: 0px;
  margin-right: 10px;
  padding: 0px;
}
.choixM label {
  font-size: 15px;
  font-family: Georgia, "Times New Roman", Times, serif;
  background-color: inherit !important;
}
.input-wrapper {
  width: 50%;
  display: flex;
  flex-direction: column;
}

.input-wrapper select {
  width: 90%;
}
.input-wrapper input {
  width: 90%;
  border: 1px solid #ccc;
  transition: border-color 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
  border-radius: 4px;
}
.checkbox-wrapper label {
  margin: 0px;
  font-size:14px;
  font-weight: 600;
  font-family: none;
}
.background {
  display: flex;
  background-color:#f8f8f8 !important;
  /* Assurez-vous que l'image couvre toute la zone */
  background-position: center;

  flex-direction: column;
  align-items: center;
}
  .form-controxl:hover {
    background-color: rgba(73, 188, 76, 0.08);
}




.content {
  display: flex;
  height: max-content;
  border: 5px solid #ccc;
  margin: 2%;
  border-radius: 5px;
  width: 100%;
}

.accept_terms {
  display: flex;
  align-items: center;
  margin: 10px;
}

.custom-select {
  /* Ajouter les styles de base du champ de sélection ici */
}




</style>

<script>
import Footer from "../views-home/Footer.vue";
import Layout from "../views-home/Layout.vue";
import axios from "../router/axios-config.js";
import { ref } from "vue";
import VueDatepicker from "@vuepic/vue-datepicker";
import "@fortawesome/fontawesome-free/css/all.css";

const date = ref();



export default {
  components: {
    Layout,
    Footer,
    VueDatepicker,
  },
  data() {
    const today = new Date();
    const maxDateOfBirth = new Date(
      today.getFullYear() - 18,
      today.getMonth(),
      today.getDate()
    )
      .toISOString()
      .split("T")[0];

    return {
      dateNaissance: "", //conditions les dates naissances & date mise en circulation
      maxDateOfBirth: maxDateOfBirth,
      maxDate: new Date().toISOString().split("T")[0],
      selectedDate: null,
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
        .then(function (response) {
          console.log(response);
        })
        .catch((error) => {
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
