<template>
  <Header />
  <div class="background">
    <!--  <div class="containerTitre">
        <h1 class="titleF">Obtenez votre devis d’assurance auto en 3 minutes        </h1>
      </div>-->
    <div class="content">
      <form class="form-horizontal" @submit.prevent="validate" method="post">
        <div class="test">
          <label class="sousTitre">Quel est votre type de motorisation ?</label>
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
              />
              <label :for="'motorisation_' + motorisation.id">{{ motorisation.typeM }}</label>
            </div>
          </div>
          <div v-show="!selectedMotorisation && motorisationTouched" class="error-message">
            Veuillez sélectionner un type de motorisation.
          </div>
        </div>
        <div class="inputs">
          <div class="input-wrapper">
            <label class="title" for="puissanceFiscale">Puissance Fiscale:</label>
            <select id="puissanceFiscale" v-model="puissanceFiscale" required>
              <option value="" disabled selected>Choisissez la puissance</option>
              <option v-for="value in options" :value="value">{{ value }}</option>
            </select>
            <div v-if="!puissanceFiscale && valeurTouched" class="error-message">
              Attention, veuillez sélectionner une valeur.
            </div>
          </div>

          <div class="input-wrapper">
            <label for="example-input">Date de mise en Circulation</label>
            <input type="date" name="bday" required pattern="\d{4}-\d{2}-\d{2}" />
            <div v-if="!dateCirculation && valeurTouched" class="error-message">
              Attention, veuillez sélectionner date de mise en circulation.
            </div>

            <!--
    <b-input-group class="mb-3">
      <b-form-input
        id="example-input"
        v-model="value"
        type="text"
        placeholder="YYYY-MM-DD"
        autocomplete="off"
      ></b-form-input>
      <b-input-group-append>
        <b-form-datepicker
          v-model="value"
          button-only
          right
          locale="en-US"
          aria-controls="example-input"
          @context="onContext"
        ></b-form-datepicker>
      </b-input-group-append>
    </b-input-group>
    <p class="mb-1">Value: '{{ value }}'</p>
    <p class="mb-1">Selected: '{{ selected }}'</p>
    <p>Formatted: '{{ formatted }}'</p>
  -->
          </div>
        </div>
        <div class="inputs">
          <div class="input-wrapper">
            <label for="marque">Marque :</label>
            <select v-model="selectedMarque" class="form-control" id="marque">
              <option value="" disabled selected>Choisissez une marquz</option>
              <option v-for="marque in marques" :key="marque.id" :value="marque.id">
                {{ marque.nomMarque }}
              </option>
            </select>
            <div v-if="!marque && valeurTouched" class="error-message">
              Attention, veuillez sélectionner une marque.
            </div>
          </div>
          <div class="input-wrapper">
            <label for="marque">Modele :</label>
            <select v-model="selectedMarque" class="form-control" id="marque">
              <option value="" disabled selected>Choisissez une marque</option>
              <option v-for="marque in marques" :key="marque.id" :value="marque.id">
                {{ marque.nomMarque }}
              </option>
            </select>
            <div v-if="!modele && valeurTouched" class="error-message">
              Attention, veuillez sélectionner un modele.
            </div>
          </div>
        </div>
        <diV class="inputs">
          <div class="input-wrapper">
            <!--<label class="sousTitre">Quel est votre type de motorisation ?</label>-->
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
            <label for="exampleInputEmail1">Valeur Vénale </label>
            <input
              v-model="valeurVenale"
              min="0"
              type="number"
              class="form-control"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              placeholder="Enter email"
            />
            <div v-show="!valeurVenale && valeurTouched" class="error-message">
              Valeur vénale doit être supérieure à 0 et inferieure ou égale à la valeur à neuf .
            </div>
          </div>
        </diV>
        <div class="inputs">
          <div class="input-wrapper">
            <label for="example-input">Date de mise en Circulation</label>
            <input type="date" name="bday" required pattern="\d{4}-\d{2}-\d{2}" />
            <div v-if="!dateNaissance && valeurTouched" class="error-message">
              L'âge du conducteur doit être supérieur ou égal à 16 ans
            </div>
          </div>
          <div class="input-wrapper">
            <label for="marque">Ville :</label>
            <select v-model="selectedVille" class="form-control" id="ville">
              <option value="" disabled selected>Choisissez une ville</option>
              <option v-for="ville in villes" :key="ville.id" :value="ville.id">
                {{ ville.nomVille }}
              </option>
            </select>
            <div v-if="!ville && valeurTouched" class="error-message">
              Attention, veuillez sélectionner une ville.
            </div>
          </div>
        </div>
        <div>
          <label>Depuis quand avez-vous votre permis de conduire?</label>
          <div class="choixM">
            <div class="checkbox-wrapper">
              <input
                type="radio"n
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
          <!--
        <vue-recaptcha @verify="onCaptchaVerified"></vue-recaptcha>
        <input type="submit" value="Submit" class="fb9" />-->
          <span v-if="!experiencePermis && submitted" class="error"
            >Veuillez sélectionner votre expérience de permis de conduire</span
          >
        </div>
        <div class="checkbox-wrapper">
          <input type="checkbox" id="acceptTerms" required />
          <label for="acceptTerms"
            >J'accepte les conditions générales d'utilisation, notamment la mention relative à la
            protection des données personnelles.</label
          >
        </div>
        <div>
          <!--
      <vue-recaptcha
      ref="recaptcha"
      @verify="onCaptchaVerify"
      @expired="onCaptchaExpired"
      sitekey="VOTRE_SITE_KEY"
    ></vue-recaptcha>-->
        </div>
        <!--
    <vue-recaptcha ref="recaptcha" @verify="onVerify"></vue-recaptcha>-->
        <button @click="validate">Valider</button>
      </form>
    </div>
    <div class="contact">
      <h5>Besoin d'aide ?</h5>
      <h6>Contactez nous du lundi au vendredi de 9h à 18h</h6>
      <button>
        <fa-icon icon="phone" />
        <h4>0650359007</h4>
      </button>
    </div>
  </div>
</template>
<style>
.background {
  display: flex;
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
.choixM input[type='radio'] {
  margin-right: 15px;
  transform: scale(1.5); /* Mise à l'échelle du bouton radio */
  margin-right: 15px;
  margin-left: 10px;
}

.choixM label {
  padding-right: 50px;
  display: inline-block;
  font-family: 'Courier New', Courier, monospace;
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
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; /* Espacement entre le label et la select */
}

.input-wrapper * {
  padding: 7px; /* Ajoute un peu de rembourrage autour de la select */
  width: 90%;
  margin-left: 10px; /* Prend toute la largeur disponible */
}
</style>

<script>
import Header from '../views-home/Header.vue'
import axios from '../router/axios-config.js'
import { fas } from '@fortawesome/free-solid-svg-icons'

//import VueRecaptcha from 'vue-recaptcha'

//Vue.component('vue-recaptcha', VueRecaptcha)

export default {
  components: {
    Header
  },
  data() {
    return {
      motorisations: [], // Assurez-vous de définir correctement vos données de motorisation
      selectedMotorisation: null,
      motorisationTouched: false,
      valeurNouvelle: null,
      valeurVenale: null,
      valeurTouched: false,
      nom: '',
      nomTouched: false,
      messages: {
        nom: 'Le nom est un champ obligatoire.'
      },
      experiencePermis: '',
      villes: [],
      selectedVille: null,
      marques: [],
      selectedMarque: '',
      value: '',
      formatted: '',
      selected: '',
      selectedMotorisation: '',
      submitted: false,
      motorisations: [],
      puissanceFiscale: '',
      submitted: false,
      options: Array.from({ length: 100 }, (_, i) => i + 1)
    }
  },
  mounted() {
    axios
      .get('/Typem')
      .then((response) => {
        this.motorisations = response.data
        console.log(this.motorisations)
      })
      .catch((error) => {
        console.error('Erreur lors du chargement des motorisations:', error)
      })
    axios
      .get('/Marques')
      .then((response) => {
        this.marques = response.data
        console.log(this.marques) // Vérifie que les données sont correctement récupérées
      })
      .catch((error) => {
        console.error('Une erreur est survenue : ', error)
      })
    axios.get('/Villes').then((response) => {
      this.villes = response.data
      console.log(this.villes) // Vérifie que les données sont correctement récupérées
    })
  },
  methods: {
    /* onContext(ctx) {
        // The date formatted in the locale, or the `label-no-date-selected` string
        this.formatted = ctx.selectedFormatted
        // The following will be an empty string until a valid date is entered
        this.selected = ctx.selectedYMD
      },*/
    validate() {
      this.valeurTouched = true
      this.motorisationTouched = true
      this.nomTouched = true

      // Autres logiques de soumission du formulaire ici
    }

    /*onCaptchaVerified(response) {
      console.log('Captcha verified with response:', response);
      // Vous pouvez envoyer le token de reCAPTCHA au backend pour vérification
    },
    submitForm() {
      // Vous pouvez soumettre votre formulaire ici après la vérification du reCAPTCHA
      console.log('Formulaire soumis');
    }*/
  }
}
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
