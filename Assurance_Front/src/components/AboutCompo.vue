<template>
  <Header />
  <div class="background">
    <form class="form-horizontal" @submit.prevent="submitForm" method="post">
      <h1 class="titre" style="color:red">   Quel est votre type de motorisation </h1>
      <div
        class="checkbox-wrapper"
        v-for="motorisation in motorisations"
        :key="motorisation.id"
      >
      <div class="sqa">
        <input
          type="radio"
          :id="'motorisation_' + motorisation.id"
          :value="motorisation.id"
          v-model="selectedMotorisation"
        />
        <label :for="'motorisation_' + motorisation.id" >{{ motorisation.typeM }}</label>
      </div></div>
      <!--
      <div v-show="!selectedMotorisation && motorisationTouched" class="error-message">
        Veuillez sélectionner un type de motorisation.
      </div>-->

      <div class="input-wrapper">
        <label for="puissFiscale">Puissance fiscale :</label>
        <select
          v-model="selectedPuissFiscale"
          class="form-control"
          id="puissFiscale"
          required
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
        <label for="exampleInputEmail1">Valeur à nouveau</label>
        <input
          v-model="valeurNouvelle"
          min="0"
          type="number"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          placeholder="Enter le prix "
          required
        />
        <div v-show="valeurTouched && !valeurNouvelle" class="error-message">
          La valeur à neuf est sous-estimée .
        </div>
      </div>

      <div class="input-wrapper">
        <label for="exampleInputEmail1">Valeur Vénale</label>
        <input
          v-model="valeurVenale"
          min="0"
          max="valeurNouvelle"
          type="number"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          placeholder="Enter email"
          required
        />
        <div v-if="!valeurVenale && valeurTouched" class="error-message">
          Donnez une valeur pour le prix vénal.
        </div>
      </div>
      <div class="input-wrapper">
        <label for="marque">Marque :</label>
        <select v-model="selectedMarque" class="form-control" id="marque" required>
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
        <select v-model="selectedModele" class="form-control" id="modele" required>
          <option v-for="modele in modeles" :key="modele.id" :value="modele.id">
            {{ modele.nomModele }}
          </option>
        </select>
        <div v-if="!selectedModele && valeurTouched" class="error-message">
          Attention, veuillez sélectionner un modèle.
        </div>
      </div>
      <!-- <div class="input-wrapper">
          <label for="valeurNouvelle">Valeur à nouveau</label>
          <input v-model="valeurNouvelle" :max="valeurVenale" type="number" class="form-control" id="valeurNouvelle" aria-describedby="valeurNouvelleHelp" placeholder="Entrer le prix" required />
          <div v-show="valeurTouched && (valeurNouvelle >= valeurVenale)" class="error-message">
              La valeur à nouveau doit être inférieure à la valeur vénale.
          </div>
      </div>
      
      <div class="input-wrapper">
          <label for="valeurVenale">Valeur Vénale</label>
          <input v-model="valeurVenale" :min="valeurNouvelle" type="number" class="form-control" id="valeurVenale" aria-describedby="valeurVenaleHelp" placeholder="Entrer valeur vénale" required />
          <div v-if="!valeurVenale && valeurTouched" class="error-message">
              Donnez une valeur pour le prix vénal.
          </div>
      </div>-->
      <div class="input-wrapper">
        <label for="valeurVenale">Valeur Vénale</label>
        <input
          v-model="valeurVenale"
          type="number"
          class="form-control"
          id="valeurVenale"
          placeholder="Entrez la valeur vénale"
          required
        />
        <div v-if="valeurTouched && !valeurVenale" class="error-message">
          La valeur vénale est requise.
        </div>
      </div>

      <div class="input-wrapper">
        <label for="valeurVenale">Valeur Vénale</label>
        <input
          v-model="valeurVenale"
          min="0"
          type="number"
          class="form-control"
          id="valeurVenale"
          aria-describedby="valeurVenaleHelp"
          placeholder="Entrer valeur vénale"
          required
        />
        <div v-if="valeurTouched && !valeurVenale" class="error-message">
          La valeur vénale est requise.
        </div>
      </div>

      <div class="input-wrapper">
        <label for="dateCirculation">Date de mise en Circulation</label>
        <input
          type="date"
          name="dateCirculation"
          v-model="dateCirculation"
          required
          pattern="\d{4}-\d{2}-\d{2}"
        />
        <div v-if="!dateCirculation && valeurTouched" class="error-message">
          Attention, veuillez sélectionner une date de mise en circulation.
        </div>
      </div>

      <!-- Champs non insérés dans la table "véhicules" -->
      <div class="input-wrapper">
        <label for="dateNaissance">Date de naissance du conducteur :</label>
        <input
          type="date"
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

      <!-- Expérience de permis de conduire -->
      <div>
        <label>Depuis quand avez-vous votre permis de conduire?</label>
        <div class="choixM">
          <div class="checkbox-wrapper">
            <input
              type="radio"
              id="moins_de_5_ans"
              name="experiencePermis"
              value="Moins de 5 ans"
              v-model="experiencePermis"
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
            />
            <label for="plus_de_20_ans">Plus de 20 ans</label>
          </div>
        </div>
        <span v-if="!experiencePermis && submitted" class="error"
          >Veuillez sélectionner votre expérience de permis de conduire</span
        >
      </div>

      <!-- Acceptation des conditions générales -->
      <div class="checkbox-wrapper">
        <input type="checkbox" id="acceptTerms" required />
        <label for="acceptTerms"
          >J'accepte les conditions générales d'utilisation, notamment la mention relative
          à la protection des données personnelles.</label
        >
      </div>
      <!-- Bouton de soumission Tarificatio
        <router-link id="link"  to="/tarification">n </router-link>-->

      <button type="submit">Valider</button>
    </form>
    <div class="contact">
      <h5>Besoin d'aide ?</h5>
      <h6>Contactez nous du lundi au vendredi de 9h à 18h</h6>
      <button>
        <fa-icon icon="phone" />
        <h4>065035907</h4>
      </button>
    </div>
  </div>
</template>
<style>
.background {
  display: flex;
}
.checkbox-wrapper > * {
  background-color: violet;
}
.contact {
  width: 15%;
  background-color: rosybrown;
  margin-right: 1%;
  margin-top: 2%;
  height: max-content;
  margin-top: 2%;
}
.containerTitre {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 12px;
}

.titleF {
  text-align: center;
  color: rgb(102, 102, 237);
  font-size: 48px !important;
}
.content {
  display: flex;
  height: max-content;
  border: 5px solid #ccc;
  padding: 20px;
  margin-top: 2%;
  margin-left: 3%;
  border-radius: 5px;
  width: 70%;
  background-color: rgb(246, 232, 208);
}
.form-horizontal {
  display: flex;
  flex-direction: column;
  border-color: rgb(9, 8, 9);
  border-radius: 5px;
}

.sousTitre {
  letter-spacing: 0.5px;
  font-size: 18px;
  font-weight: bold;
  padding-left: 2%;
  color: rgb(19, 79, 208);
}
.choixM {
  display: flex;
  align-items: center;
  padding-left: 2%;
}
.choixM .checkbox-wrapper {
  border: 1px solid #090909;
  border-radius: 10px;
  padding: 10px; /* Espace entre la bordure et son contenu */
  display: flex; /* Utilisation de flexbox pour aligner les éléments verticalement */
  align-items: center; /* Centrer verticalement les éléments */
  margin: 5px;
  width: max-content;

  /* Pour que la bordure englobe les éléments */
}
.choixM input[type="radio"] {
  margin-right: 15px;
  transform: scale(1.5); /* Mise à l'échelle du bouton radio */
  margin-right: 15px;
  margin-left: 10px;
}

.choixM label {
  padding-right: 50px;
  display: inline-block;
  font-family: "Courier New", Courier, monospace;
  font-size: 20px;
}
.inputs {
  display: flex;
  margin-top: 15px;
  background-color: inherit;
  justify-content: center;
  align-items: center;
}

.input-wrapper {
  width: 50%; /* Pour que les éléments prennent 48% de la largeur du conteneur */
  margin-left: 2%;
  padding-bottom: 13px;
  display: flex;
  flex-direction: column; /* Pour placer le label au-dessus de la select */
  margin-bottom: 10px;
  background-color: inherit;
}
.input-wrapper label {
  margin-bottom: 5px;
  color: #0d0d0d;
  font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif; /* Espacement entre le label et la select */
}

.input-wrapper * {
  padding: 7px; /* Ajoute un peu de rembourrage autour de la select */
  width: 90%;
  margin-left: 10px; /* Prend toute la largeur disponible */
}

</style>

<script>
import Header from "../views-home/Header.vue";
import axios from "../router/axios-config.js";
import { fas } from "@fortawesome/free-solid-svg-icons";

//import VueRecaptcha from 'vue-recaptcha'

//Vue.component('vue-recaptcha', VueRecaptcha)

export default {
  components: {
    Header,
  },
  data() {
    return {
      valeurNouvelle: "",
      selectedPuissFiscale: "",
      experiencePermis: "",
      villes: [],
      valeurVenale: "",
      valeurTouched: false,
      selectedPuissFiscale: null,
      puissancesFiscale: [],
      selectedVille: null,
      marques: [],
      selectedMarque: "",
      value: "",
      formatted: "",
      selected: "",
      selectedMotorisations: "",
      selectedMotorisations: [],
      submitted: false,
      motorisations: [],
      puissanceFiscale: "",
      submitted: false,
      errors: {},
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
.form-container {
  margin-top: 10%;
  width: 80%;
  margin-right: 3%;
  margin-left: 3%;
  background-color: rgb(171, 168, 163);
  padding: 20px;
}
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
