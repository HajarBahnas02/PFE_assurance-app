<template>
  <Layout />
  <div class="multi_step_form">
    <div id="msform">
      <div class="tittle">
        <h2>Obtenir votre devis en quelques minutes</h2>
      </div>
      <ul id="progressbar">
        <li v-for="(step, index) in formSteps" :key="'step' + index" :class="{'active': index === activeStep}">{{ index + 1 }}</li>
      </ul>
      <form @submit.prevent="submitForm">
        <fieldset v-if="activeStep === 0">
          <h3>Informations Véhicule</h3>
          <div class="form-group">
            <label for="typeMotorisation">Type motorisation:</label>
            <div class="radio-wrapper">
              <div
                v-for="typeMotorisation in typeMotorisations"
                :key="typeMotorisation.id"
                :class="['radio-option', { selected: form.type_motorisation_id === typeMotorisation.id }]"
              >
                <input
                  type="radio"
                  :id="`type_motorisation_${typeMotorisation.id}`"
                  v-model="form.type_motorisation_id"
                  :value="typeMotorisation.id"
                />
                <label :for="`type_motorisation_${typeMotorisation.id}`">{{ typeMotorisation.typeM }}</label>
              </div>
            </div>
            <span v-if="errors.type_motorisation_id" class="error">{{ errors.type_motorisation_id }}</span>
          </div>
          <div class="form-group">
            <label for="matricule">Matricule:</label>
            <input type="text" v-model="form.matricule" />
            <span v-if="errors.matricule" class="error">{{ errors.matricule }}</span>
          </div>
         <div class="horizantal">
          <div class="form-group">
            <label for="marque">Marque:</label>
            <select v-model="form.marque_id">
              <option disabled value="">Sélectionner une marque</option>
              <option v-for="marque in marques" :key="marque.id" :value="marque.id">{{ marque.nomMarque }}</option>
            </select>
            <span v-if="errors.marque_id" class="error">{{ errors.marque_id }}</span>
          </div>
          <div class="form-group">
            <label for="modele">Modèle:</label>
            <select v-model="form.modele_id">
              <option disabled value="">Sélectionner un modèle</option>
              <option v-for="modele in modeles" :key="modele.id" :value="modele.id">{{ modele.nomModele }}</option>
            </select>
            <span v-if="errors.modele_id" class="error">{{ errors.modele_id }}</span>
          </div></div>
            <div class="horizantal"> 
          <div class="form-group">
            <label for="puissanceFiscale">Puissance fiscale:</label>
            <select v-model="form.puissanceFiscale">
              <option disabled value="">Sélectionner une puissance fiscale</option>
              <option v-for="puissance in puissancesfisc" :key="puissance.id" :value="puissance.PuissFiscale">{{ puissance.PuissFiscale }}</option>
            </select>
            <span v-if="errors.puissanceFiscale" class="error">{{ errors.puissanceFiscale }}</span>
          </div>
          <div class="form-group">
            <label for="dateMiseEnCirculation">Date de mise en circulation:</label>
            <input type="date" v-model="form.dateMiseEnCirculation" :max="today" />
            <span v-if="errors.dateMiseEnCirculation" class="error">{{ errors.dateMiseEnCirculation }}</span>
          </div></div>
          <div class="horizantal">
          <div class="form-group">
            <label for="valeurNeuve">Valeur neuve:</label>
            <input type="number" v-model="form.valeurNeuve" />
            <span v-if="errors.valeurNeuve" class="error">{{ errors.valeurNeuve }}</span>
          </div>
          <div class="form-group">
            <label for="valeurVenale">Valeur vénale:</label>
            <input type="number" v-model="form.valeurVenale" />
            <span v-if="errors.valeurVenale" class="error">{{ errors.valeurVenale }}</span>
          </div></div>
          <button type="button" @click="validateStep1">Suivant</button>
        </fieldset>
        <fieldset v-if="activeStep === 1">
          <h3>Informations Client</h3>
          <div class="horizantal">
          <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" v-model="formCl.nom" />
            <span v-if="errorsCl.nom" class="error">{{ errorsCl.nom }}</span>
          </div>
          <div class="form-group">
            <label for="prenom">Prénom:</label>
            <input type="text" v-model="formCl.prenom" />
            <span v-if="errorsCl.prenom" class="error">{{ errorsCl.prenom }}</span>
          </div></div>
         
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" v-model="formCl.email" />
            <span v-if="errorsCl.email" class="error">{{ errorsCl.email }}</span>
          </div> <div class="horizantal">
          <div class="form-group">
            <label for="dateDebut">Date de Début</label>
            <input type="date" v-model="formDev.dateDebut" min="today" />
            <span v-if="errors.dateDebut" class="error">{{ errors.dateDebut }}</span>
          </div>
          <div class="form-group">
            <label for="telephone">Téléphone:</label>
            <input type="tel" v-model="formCl.telephone" />
            <span v-if="errorsCl.telephone" class="error">{{ errorsCl.telephone }}</span>
          </div></div>
          <div class="horizantal">
          <div class="form-group">
            <label for="ville">Ville:</label>
            <select v-model="formCl.ville_id">
              <option disabled value="">Sélectionner une ville</option>
              <option v-for="ville in villes" :key="ville.id" :value="ville.id">{{ ville.nomVille }}</option>
            </select>
            <span v-if="errorsCl.ville_id" class="error">{{ errorsCl.ville_id }}</span>
          </div>
          <div class="form-group">
            <label for="date_naissance">Date de naissance:</label>
            <input type="date" v-model="formCl.date_naissance" :max="maxBirthDate" />
            <span v-if="errorsCl.date_naissance" class="error">{{ errorsCl.date_naissance }}</span>
          </div></div>
          
      <div class="horizantal">
          <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" v-model="formCl.password" />
            <span v-if="errorsCl.password" class="error">{{ errorsCl.password }}</span>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirmer le mot de passe:</label>
            <input type="password" v-model="formCl.confirmPassword" />
            <span v-if="errorsCl.confirmPassword" class="error">{{ errorsCl.confirmPassword }}</span>
        </div></div>
          <button type="button" @click="prevStep" class="previous_button">Précédent</button>
          <button type="button" @click="validateStep2">Suivant</button>

        
        </fieldset>
        <fieldset v-if="activeStep === 2">
          <h1>Types de Garanties</h1>
          <div v-for="garantie in garanties" :key="garantie.id" class="garantie">
            <input type="checkbox" :id="'garantie-' + garantie.id" v-model="selectedGaranties" :value="garantie.id">
            <label :for="'garantie-' + garantie.id">{{ garantie.nomTypeGarantie }}</label>
            
            <div v-if="garantie.options_garanties.length" class="garantie-options">
              <label :for="'options-' + garantie.id">Options:</label>
              <select v-model="selectedOptions[garantie.id]" :id="'options-' + garantie.id">
                <option v-for="option in garantie.options_garanties" :key="option.id" :value="option.id">
                  {{ option.nom }}
                </option>
              </select>
            </div>
          </div>
          <button type="button" @click="prevStep" class="previous_button">Précédent</button>
          <button type="submit">Soumettre</button>
        </fieldset>      </form>
    </div>
  </div> <Footer />
</template>

<script>
import axios from "../router/axios-config.js";
import Footer from "../views-home/Footer.vue";
import Layout from "../views-home/Layout.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
  components: {
    Layout,
    Footer,
  },
  data() {
    return {
      form: {
        matricule: "",
        puissanceFiscale: "",
        dateMiseEnCirculation: "",
        valeurNeuve: "",
        valeurVenale: "",
        marque_id: "",
        modele_id: "",
        type_motorisation_id: "",
      },
      formCl: {
        nom: "",
        prenom: "",
        email: "",
        telephone: "",
        ville_id: "",
        date_naissance: "",
        password: '',
      confirmPassword: ''
      },
      formDev: {
        dateDebut: "",
      },
      marques: [],
      modeles: [],
      typeMotorisations: [],
      puissancesfisc: [],
      villes: [],
      garanties: [],
      selectedGaranties: [],
      selectedOptions: {},
      errors: {},
      errorsCl: {},
      loading: false,
      formSteps: ['Informations Véhicule', 'Informations Client', 'Garanties'],
      activeStep: 0,
    };
  },
  created() {
    this.fetchData();
    this.fetchGaranties();

  },
  computed: {
    today() {
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, "0");
      const day = String(today.getDate()).padStart(2, "0");
      return `${year}-${month}-${day}`;
    },
    maxBirthDate() {
      const today = new Date();
      const year = today.getFullYear() - 18;
      const month = String(today.getMonth() + 1).padStart(2, "0");
      const day = String(today.getDate()).padStart(2, "0");
      return `${year}-${month}-${day}`;
    },
  },
  methods: {
    submitGaranties(devisId) {
  // Boucle sur les garanties sélectionnées
  this.selectedGaranties.forEach(async (garantieId) => {
    try {
      const response = await axios.post('/devis_garanties', {
        garantie_id: garantieId,
        devis_id: devisId
      });
      console.log('Garantie enregistrée avec succès:', response.data);
    } catch (error) {
      console.error('Erreur lors de l\'enregistrement de la garantie:', error);
    }
  });
},
    validateStep1() {
    this.errors = {};

    if (!this.form.matricule) this.errors.matricule = "Ce champ est obligatoire";
    if (!this.form.puissanceFiscale) this.errors.puissanceFiscale = "Ce champ est obligatoire";
    if (!this.form.dateMiseEnCirculation) {
      this.errors.dateMiseEnCirculation = "Ce champ est obligatoire";
    } else if (this.form.dateMiseEnCirculation > this.today) {
      this.errors.dateMiseEnCirculation = "La date de mise en circulation doit être aujourd'hui ou avant";
    }
    if (!this.form.valeurNeuve) this.errors.valeurNeuve = "Ce champ est obligatoire";
    if (!this.form.valeurVenale) {
      this.errors.valeurVenale = "Ce champ est obligatoire";
    } else if (parseFloat(this.form.valeurVenale) > parseFloat(this.form.valeurNeuve)) {
      this.errors.valeurVenale = "La valeur vénale doit être inférieure ou égale à la valeur neuve";
    }
    if (!this.form.marque_id) this.errors.marque_id = "Ce champ est obligatoire";
    if (!this.form.modele_id) this.errors.modele_id = "Ce champ est obligatoire";
    if (!this.form.type_motorisation_id) this.errors.type_motorisation_id = "Ce champ est obligatoire";

    if (Object.keys(this.errors).length === 0) {
        this.nextStep();
      }},
      validateStep2() {
      this.errorsCl = {};

      if (!this.formCl.nom) this.errorsCl.nom = "Ce champ est obligatoire";
      if (!this.formCl.prenom) this.errorsCl.prenom = "Ce champ est obligatoire";
      if (!this.formCl.email) this.errorsCl.email = "Ce champ est obligatoire";
      if (!this.formCl.telephone) this.errorsCl.telephone = "Ce champ est obligatoire";
      if (!this.formCl.ville_id) this.errorsCl.ville_id = "Ce champ est obligatoire";
      if (!this.formCl.date_naissance) {
        this.errorsCl.date_naissance = "Ce champ est obligatoire";
      } else if (new Date(this.formCl.date_naissance) > new Date(this.maxBirthDate)) {
        this.errorsCl.date_naissance = "Vous devez avoir au moins 18 ans";
      }
      if (!this.formCl.password) {
        this.errorsCl.password = "Ce champ est obligatoire";
      } else if (this.formCl.password.length < 8) {
        this.errorsCl.password = "Le mot de passe doit contenir au moins 8 caractères";
      }
      if (!this.formCl.confirmPassword) {
        this.errorsCl.confirmPassword = "Ce champ est obligatoire";
      } else if (this.formCl.password !== this.formCl.confirmPassword) {
        this.errorsCl.confirmPassword = "Les mots de passe ne correspondent pas";
      }

      if (Object.keys(this.errorsCl).length === 0) {
        this.nextStep();
      }
    },
    nextStep() {
      this.activeStep++;
    },
    
    prevStep() {
      this.activeStep--;
    },
    fetchData() {
      axios
        .get("/Marques",{ timeout: 20000 })
        .then((response) => {
          this.marques = response.data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des marques:", error);
        });

      axios
        .get("/PuissanceFiscale",{ timeout: 20000 })
        .then((response) => {
          this.puissancesfisc = response.data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des puissances fiscales:", error);
        });

      axios
        .get("/Modele",{ timeout: 20000 })
        .then((response) => {
          this.modeles = response.data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des modèles:", error);
        });

      axios
        .get("/Typem",{ timeout: 20000 })
        .then((response) => {
          this.typeMotorisations = response.data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des types de motorisation:", error);
        });

      axios
        .get("/Villes" ,{ timeout: 10000 })
        .then((response) => {
          this.villes = response.data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des villes:", error);
        });
    },
    async fetchGaranties() {
      try {
        const response = await axios.get('/garanties',{ timeout: 20000 });
        this.garanties = response.data;
      } catch (error) {
        console.error('Error fetching garanties:', error);
      }
    },
    validateForm() {
      this.errors = {};
      this.errorsCl = {};

      if (!this.form.matricule) this.errors.matricule = "Ce champ est obligatoire";
      if (!this.form.puissanceFiscale)
        this.errors.puissanceFiscale = "Ce champ est obligatoire";
      if (!this.form.dateMiseEnCirculation) {
        this.errors.dateMiseEnCirculation = "Ce champ est obligatoire";
      } else if (this.form.dateMiseEnCirculation > this.today) {
        this.errors.dateMiseEnCirculation =
          "La date de mise en circulation doit être aujourd'hui ou avant";
      }
      if (!this.form.valeurNeuve) this.errors.valeurNeuve = "Ce champ est obligatoire";
      if (!this.form.valeurVenale) {
        this.errors.valeurVenale = "Ce champ est obligatoire";
      } else if (parseFloat(this.form.valeurVenale) > parseFloat(this.form.valeurNeuve)) {
        this.errors.valeurVenale =
          "La valeur vénale doit être inférieure ou égale à la valeur neuve";
      }
      if (!this.form.marque_id) this.errors.marque_id = "Ce champ est obligatoire";
      if (!this.form.modele_id) this.errors.modele_id = "Ce champ est obligatoire";
      if (!this.form.type_motorisation_id)
        this.errors.type_motorisation_id = "Ce champ est obligatoire";
      if (!this.formCl.nom) this.errorsCl.nom = "Ce champ est obligatoire";
      if (!this.formCl.prenom) this.errorsCl.prenom = "Ce champ est obligatoire";
      if (!this.formCl.email) this.errorsCl.email = "Ce champ est obligatoire";
      if (!this.formCl.telephone) this.errorsCl.telephone = "Ce champ est obligatoire";
      if (!this.formCl.ville_id) this.errorsCl.ville_id = "Ce champ est obligatoire";
      if (!this.formCl.date_naissance) {
        this.errorsCl.date_naissance = "Ce champ est obligatoire";
      } else if (new Date(this.formCl.date_naissance) > new Date(this.maxBirthDate)) {
        this.errorsCl.date_naissance = "Vous devez avoir au moins 18 ans";
      }
      if (!this.formCl.password) {
    this.errorsCl.password = "Ce champ est obligatoire";
  } else if (this.formCl.password.length < 8) {
    this.errorsCl.password = "Le mot de passe doit contenir au moins 8 caractères";
  }
  if (!this.formCl.confirmPassword) {
    this.errorsCl.confirmPassword = "Ce champ est obligatoire";
  } else if (this.formCl.password !== this.formCl.confirmPassword) {
    this.errorsCl.confirmPassword = "Les mots de passe ne correspondent pas";
  }
      return (
        Object.keys(this.errors).length === 0 && Object.keys(this.errorsCl).length === 0
      );
    },
    nextStep() {
      this.activeStep++;
    },
  
    submitForm() {
      this.loading = true;
      if (this.validateForm()) {
        axios.post('vehicules', this.form, {}, { timeout: 20000 })
          .then(response => {
            alert('Véhicule créé avec succès!');
            axios
              .post("/clients_form", this.formCl,{ timeout: 20000 })
              .then((clientResponse) => {
                const clientId = clientResponse.data.client.id;
                alert('Client ajouté avec succès!');
                const devisData = {
                  matricule: this.form.matricule,
                  client_id: clientId,
                  date_debut: this.formDev.dateDebut,
                  
                };
                axios.post('/enregistrer', devisData,{ timeout: 20000 })
                  .then(devisResponse => {
                    alert('Devis créé avec succès!');
                    const devisId = devisResponse.data.devis?.id; // Utilisez l'opérateur optionnel pour éviter les erreurs si devis est indéfini
                console.log('Devis ID:', devisId);
                     this.submitGaranties(devisId);
                    this.resetForm();
                    this.$router.push({ name: 'espace-client', params: { clientId: clientId } });

                  })
                  .catch((error) => {
                    console.error("Erreur lors de la création du devis:", error);
                  });
                
                })
          
              .catch((error) => {
                console.error("Erreur lors de l'ajout du client:", error);
              });
          })
          .catch(error => {
            console.error('Erreur lors de la création du véhicule:', error);
          })
          .finally(() => {
            this.loading = false;
          });
  

      }
    },
    resetForm() {
      this.form = {
        matricule: "",
        puissanceFiscale: "",
        dateMiseEnCirculation: "",
        valeurNeuve: "",
        valeurVenale: "",
        marque_id: "",
        modele_id: "",
        type_motorisation_id: "",
      };
      this.formCl = {
        nom: "",
        prenom: "",
        email: "",
        telephone: "",
        ville_id: "",
        date_naissance: "",
      };
      this.errors = {};
      this.errorsCl = {};
      this.selectedGaranties = [];
      this.selectedOptions = {};
    },
  },
};
</script>

<style scoped>
@charset "UTF-8";
/*font Variables*/
/*Color Variables*/
@import url("https://fonts.googleapis.com/css?family=Roboto:300i,400,400i,500,700,900");

.horizantal {
  display: flex;
  justify-content: space-between;
  gap: 20px;
}
fieldset h3{
  color:#1289d7;
  margin-bottom:2%;
}
.form-group {
  flex: 1; /* Each form-group will take up equal space */
  margin-right: 10px; /* Add some space to the right of each form group */
}
.form-group:last-child {
  margin-right: 0; /* Remove right margin from the last form group */
}
.multi_step_form {
  background: #bbc4bd;
  display: block;
  overflow: hidden;
}
.form-group > label {
  display: block;
  margin-right: 10px;
  font-weight: bold;
}

input[type="text"],
input[type="date"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="password"],
select {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  background-color: #f0eaee !important;
  border: 1px solid #040404;
  border-radius: 4px;
  box-sizing: border-box;
}

#msform {
  text-align: center;
  padding-top: 50px;
  margin: 0 auto;
  padding: 20px 30px;
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
  width: 90%;
  max-width: 800px;
}

.tittle {
  text-align: center;
  padding-bottom: 5px;
}

.tittle h2 {
  font: 500 24px/35px "Roboto", sans-serif;
  color: #3f4553;
  padding-bottom: 5px;
}

#progressbar {
  margin-bottom: 20px;
  overflow: hidden;
  background-color: white;
  counter-reset: step;
}

#progressbar li {
  list-style-type: none;
  color: #1289d7;
  text-transform: uppercase;
  font-size: 9px;
  width: 33.33%;
  float: left;
  position: relative;
  font: 500 13px/1 "Roboto", sans-serif;
}

#progressbar li:before {
  content: counter(step);
  counter-increment: step;
  width: 20px;
  height: 20px;
  line-height: 20px;
  display: block;
  font-size: 10px;
  color: #333;
  background: #827a7a;
  border-radius: 3px;
  margin: 0 auto 5px auto;
}

#progressbar li.active:before, #progressbar li.active {
  background: #5cb85c;
  color: white;
}

fieldset {
  border: 0;
  position: relative;
  width: 100%;
  height: max-content;
  left: 0;
  right: 0;
}



.form-group label {
  font: 500 16px/1 "Roboto", sans-serif;
  color: black;
  width: 90%;
}


.error {
  color: red;
  font-size: 12px;
  display: block; /* Ensures the error message is displayed as a block element */
  margin-top: 5px;
}

.radio-option {
  display: flex;
  align-items: center;
  gap: 4px !important;
  margin: 20px;
}

.radio-option.selected label {
  font-weight: bold;
  color: #5cb85c;
}

button {
  display: inline-block;
  padding: 10px 20px;
  border: none;
  background-color: #5cb85c;
  color: white;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #4cae4c;
}

.previous_button {
  background-color: #d9534f;
}

.previous_button:hover {
  background-color: #c9302c;
}
</style>

<style>

.multi_step_form {
  display: flex;
  justify-content: center;
  align-items: center;
  height: max-content;
}




#progressbar {
  margin-bottom: 30px;
  overflow: hidden;
  counter-reset: step;
}

#progressbar li {
  list-style-type: none;
  color: #333;
  text-transform: uppercase;
  font-size: 12px;
  width: 33.33%;
  float: left;
  position: relative;
}

#progressbar li::before {
  content: counter(step);
  counter-increment: step;
  width: 20px;
  line-height: 20px;
  display: block;
  font-size: 10px;
  color: #333;
  background: white;
  border-radius: 3px;
  margin: 0 auto 5px auto;
}

#progressbar li.active::before,
#progressbar li.active {
  color: white;
}

#progressbar li.active::before {
  background: #27ae60;
}

fieldset {
  background: white;
  border: 0 none;
  border-radius: 3px;
  box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
  padding: 20px 30px;
  box-sizing: border-box;
  width: 80%;
  margin: 0 10%;
  position: relative;
}

fieldset:not(:first-of-type) {
  display: none;
}

.form-group {
  margin-bottom: 25px;
}

.form-group label {
  display: block;
  font: 500 13px/1 "Roboto", sans-serif;
  color: #3f4553;
  margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
input[type="number"],
input[type="email"],
input[type="tel"],
select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}


.radio-wrapper {
  display: flex;
  gap: 20px;
}

.radio-option {
  display: flex;
  align-items: center;
}

.radio-option input {
  margin-right: 5px;
}



button {
  display: inline-block;
  padding: 10px 20px;
  border: none;
  background-color: #5cb85c;
  color: white;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #4cae4c;
}

.previous_button {
  background-color: #d9534f;
}

.previous_button:hover {
  background-color: #c9302c;
}
.garantie {
  margin-bottom: 15px;
  display: flex;
  margin-left: 10%;
}

.garantie input[type="checkbox"] {
  margin-right: 10px;
}

.garantie label {
  font-size: 16px;
  margin-bottom: 5px;
}

.garantie-options {
  margin-left: 20%;
  padding: 1%;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-left: 2px solid #5cb85c;
  border-top: 2px solid #5cb85c;
  border-right: 2px solid #5cb85c;
  border-bottom: 2px solid #5cb85c;
  border-radius: 5px;
}

.garantie-options label {
  margin-bottom: 5px;
  font-weight: bold;
}

.garantie-options select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-sizing: border-box;
}

button.previous_button,
button[type="submit"] {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin: 10px 5px;
}

button.previous_button:hover,
button[type="submit"]:hover {
  background-color: #0056b3;
}

</style>