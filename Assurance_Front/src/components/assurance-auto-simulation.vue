<template>
  <Layout />
  <div class="formsbutt">
    <h1>Obtenir votre devis en quelques minutes</h1>  
    <div class="content-forms">
    <div class="form-vehicule">
      <h3>Informations Véhicule</h3>
      <form @submit.prevent="submitForm">
        <label for="typeMotorisation">Type motorisation:</label>
        <div class="radio-wrapper">
          <div 
            v-for="typeMotorisation in typeMotorisations" 
            :key="typeMotorisation.id" 
            :class="['radio-option', { 'selected': form.type_motorisation_id === typeMotorisation.id }]"
          >
            <input
              type="radio"
              :id="'motorisation_' + typeMotorisation.id"
              :value="typeMotorisation.id"
              v-model="form.type_motorisation_id"
              @change="optionTouched = true"
              required
            />
            <label :for="'motorisation_' + typeMotorisation.id">{{ typeMotorisation.typeM }}</label>
          </div>
        </div>
        <span v-if="errors.type_motorisation_id" class="error">{{ errors.type_motorisation_id }}</span>
      
        <div>
          <label for="matricule">Matricule</label>
          <input type="text" v-model="form.matricule">
          <span v-if="errors.matricule" class="error">{{ errors.matricule }}</span>
        </div>

        <div>
          <label for="puissanceFiscale">Puissance Fiscale</label>
          <select v-model="form.puissanceFiscale" id="puissanceFiscale">
            <option v-for="puissance in puissancesfisc" :key="puissance.id" :value="puissance.id">
              {{ puissance.PuissFiscale }}
            </option>
          </select>
          <span v-if="errors.puissanceFiscale" class="error">{{ errors.puissanceFiscale }}</span>
        </div>

        <div>
          <label for="dateMiseEnCirculation">Date de Mise en Circulation</label>
          <input type="date" v-model="form.dateMiseEnCirculation" :max="today">
          <span v-if="errors.dateMiseEnCirculation" class="error">{{ errors.dateMiseEnCirculation }}</span>
        </div>

        <div>
          <label for="valeurNeuve">Valeur Neuve</label>
          <input type="number" step="0.01" v-model="form.valeurNeuve">
          <span v-if="errors.valeurNeuve" class="error">{{ errors.valeurNeuve }}</span>
        </div>

        <div>
          <label for="valeurVenale">Valeur Vénale</label>
          <input type="number" step="0.01" v-model="form.valeurVenale">
          <span v-if="errors.valeurVenale" class="error">{{ errors.valeurVenale }}</span>
        </div>

        <div>
          <label for="marque_id">Marque</label>
          <select v-model="form.marque_id" id="marque_id">
            <option v-for="marque in marques" :key="marque.id" :value="marque.id">
              {{ marque.nomMarque }}
            </option>
          </select>
          <span v-if="errors.marque_id" class="error">{{ errors.marque_id }}</span>
        </div>

        <div>
          <label for="modele_id">Modèle</label>
          <select v-model="form.modele_id" id="modele_id">
            <option v-for="modele in modeles" :key="modele.id" :value="modele.id">
              {{ modele.nomModele }}
            </option>
          </select>
          <span v-if="errors.modele_id" class="error">{{ errors.modele_id }}</span>
        </div>

    <!--    <div>
          <label for="type_motorisation_id">Type de Motorisation</label>
          <select v-model="form.type_motorisation_id" id="type_motorisation_id">
            <option v-for="typeMotorisation in typeMotorisations" :key="typeMotorisation.id" :value="typeMotorisation.id">
              {{ typeMotorisation.typeM }}
            </option>
          </select>
          <span v-if="errors.type_motorisation_id" class="error">{{ errors.type_motorisation_id }}</span>
        </div>-->
     
      </form>
    </div>

    <div class="form-client">
      <h3>Informations Client</h3>
      <form @submit.prevent="submitForm">
        <div>
          <label for="nom">Nom</label>
          <input type="text" v-model="formCl.nom">
          <span v-if="errorsCl.nom" class="error">{{ errorsCl.nom }}</span>
        </div>

        <div>
          <label for="prenom">Prénom</label>
          <input type="text" v-model="formCl.prenom">
          <span v-if="errorsCl.prenom" class="error">{{ errorsCl.prenom }}</span>
        </div>

        <div>
          <label for="email">Email</label>
          <input type="email" v-model="formCl.email">
          <span v-if="errorsCl.email" class="error">{{ errorsCl.email }}</span>
        </div>
        <div>
          <label for="date_naissance">Date de naissance</label>
          <input type="date" v-model="formCl.date_naissance" :max="maxBirthDate">
          <span v-if="errorsCl.date_naissance" class="error">{{ errorsCl.date_naissance }}</span>
        </div>
        <div>
          <label for="telephone">Téléphone</label>
          <input type="tel" v-model="formCl.telephone">
          <span v-if="errorsCl.telephone" class="error">{{ errorsCl.telephone }}</span>
        </div>

        <div>
          <label for="ville_id">Ville</label>
          <select v-model="formCl.ville_id">
            <option v-for="ville in villes" :key="ville.id" :value="ville.id">
              {{ ville.nomVille }}
            </option>
          </select>
          <span v-if="errorsCl.ville_id" class="error">{{ errorsCl.ville_id }}</span>
        </div>
        <div>
          <label for="dateDebut">Date de Début</label>
          <input type="date" v-model="formDev.dateDebut" min="today">
          <span v-if="errors.dateDebut" class="error">{{ errors.dateDebut }}</span>
        </div>
        <button type="submit" class="ajoutbtn">Enregistrer</button>

      </form>
    </div>  

  </div>

  </div>
  <Footer />

</template>
<style scoped>
.formsbutt h1{
  color: #165e85;
  text-align: center;
  background-color: rgb(232 233 234);
  
}

h3 {
  text-align: center;
  margin-bottom: 5%;
}
select {
  background-color: white;

}
.form-vehicule div, .form-client div {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  font-weight: bold;
}
.form-vehicule h3{
background-color: rgb(232 233 234);
border-radius: 10px;
height:50px;
}
.form-client h3{
  background-color: rgb(232 233 234);
border-radius: 10px;
height:50px;
}
label{
  font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  font-weight: bold;
}
.content-forms button{
  float: right; /* Positionne le bouton à gauche */
  background-color: #165e85;
  color: white;
  border: none;
  cursor: pointer;
}

.form-vehicule label, .form-client label {
  width: 150px;
  margin-right: 10px;
}

.form-vehicule input, .form-client input,
.form-vehicule select, .form-client select {
  flex: 1; /* Prend tout l'espace restant */
  padding: 8px;
  box-sizing: border-box;
  border: 1px solid #ccc; /* Bordure par défaut */
}

.form-vehicule input:not(:placeholder-shown), .form-client input:not(:placeholder-shown),
.form-vehicule select:valid, .form-client select:valid {
  border-color: green; /* Bordure verte quand rempli */
}

.form-vehicule input:hover, .form-client input:hover,
.form-vehicule select:hover, .form-client select:hover {
  border-color: green;
}

.form-vehicule input:focus, .form-client input:focus,
.form-vehicule select:focus, .form-client select:focus {
  border-color: green;
  outline: none;
}

.radio-wrapper {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.radio-option {
  display: flex;
  align-items: center;
  background-color: #f0f0f0;
  padding: 10px;
  border-radius: 10px;
  cursor: pointer;
  margin: 5px 0;
}

.formsbutt {
  display: flex;
  flex-direction: column;
}
.ajoutbtn{
  width: 40%;
margin-top: 30%;
}
.content-forms {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  margin: 20px 0;
}

.form-vehicule, .form-client {
  width: 45%;
  border: 2px solid rgb(16, 15, 15);
  border-radius: 10px;
  padding: 2%;
  margin-bottom: 1px; 
  backdrop-filter: blur(5px);
margin-left: 2%;
margin-right: 2%;
}
.form-vehicule div, .form-client div {
  margin-bottom: 10px;
}

.form-vehicule input, .form-client input,
.form-vehicule select, .form-client select {
  width: 80%;
  padding: 8px;
  box-sizing: border-box;
  /*border: 1px solid black;  Bordure par défaut */
}

.form-vehicule input:not(:placeholder-shown), .form-client input:not(:placeholder-shown),
.form-vehicule select:valid, .form-client select:valid {
  border-color: green; /* Bordure verte quand rempli */
}

.form-vehicule input:hover, .form-client input:hover,
.form-vehicule select:hover, .form-client select:hover {
  border-color: green;
}

.form-vehicule input:focus, .form-client input:focus,
.form-vehicule select:focus, .form-client select:focus {
  border-color: green;
  outline: none;
}

.radio-wrapper {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.radio-option {
  display: flex;
  align-items: center;
  background-color: #f0f0f0;
  padding: 10px;
  border-radius: 10px;
  cursor: pointer;
  }

.radio-option input {
  margin-right: 5px;
}

.radio-option.selected {
  background-color: green;
  color: white;
}

.radio-option label {
  cursor: pointer;
}

.error {
  color: red;
  font-size: 0.9em;
}

@media (max-width: 768px) {
  .form-vehicule, .form-client {
    width: 100%;
  }
}
</style>

<script>

import axios from "../router/axios-config.js";
import Footer from "../views-home/Footer.vue";
import Layout from "../views-home/Layout.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
  components: {
    Layout,
    Footer,},
  data() {
    return {
      form: {
        matricule: '',
        puissanceFiscale: '',
        dateMiseEnCirculation: '',
        valeurNeuve: '',
        valeurVenale: '',
        marque_id: '',
        modele_id: '',
        type_motorisation_id: '',
            },
      formCl: {
        nom: '',
        prenom: '',
        email: '',
        telephone: '',
        ville_id: '',
        date_naissance:'',
      },
      formDev: {
        dateDebut: '',
      },
      marques: [],
      modeles: [],
      typeMotorisations: [],
      puissancesfisc: [],
      villes: [],
      errors: {},
      errorsCl: {}
    };
  },
  created() {
    this.fetchData();
    this.fetchVilles();
  },
  computed: {
    today() {
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, '0');
      const day = String(today.getDate()).padStart(2, '0');
      return `${year}-${month}-${day}`;
    },
    maxBirthDate() {
      const today = new Date();
      const year = today.getFullYear() - 18;
      const month = String(today.getMonth() + 1).padStart(2, '0');
      const day = String(today.getDate()).padStart(2, '0');
      return `${year}-${month}-${day}`;
    }
  },
  methods: {
    fetchVilles() {
      axios.get('/Villes')
        .then(response => {
          this.villes = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des villes:', error);
        });
    },
    fetchData() {
      axios.get('Marques')
        .then(response => {
          this.marques = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des marques:', error);
        });

      axios.get('PuissanceFiscale')
        .then(response => {
          this.puissancesfisc = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des puissances fiscales:', error);
        });

      axios.get('Modele')
        .then(response => {
          this.modeles = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des modèles:', error);
        });

      axios.get('Typem')
        .then(response => {
          this.typeMotorisations = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des types de motorisation:', error);
        });

      axios.get('Villes')
        .then(response => {
          this.villes = response.data;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des villes:', error);
        });
    },
    validateForm() {
      this.errors = {};
      this.errorsCl = {};

      if (!this.form.matricule) this.errors.matricule = 'Ce champ est obligatoire';
      if (!this.form.puissanceFiscale) this.errors.puissanceFiscale = 'Ce champ est obligatoire';
      if (!this.form.dateMiseEnCirculation) {
        this.errors.dateMiseEnCirculation = 'Ce champ est obligatoire';
      } else if (this.form.dateMiseEnCirculation > this.today) {
        this.errors.dateMiseEnCirculation = 'La date de mise en circulation doit être aujourd\'hui ou avant';
      }
      if (!this.form.valeurNeuve) this.errors.valeurNeuve = 'Ce champ est obligatoire';
      if (!this.form.valeurVenale) {
        this.errors.valeurVenale = 'Ce champ est obligatoire';
      } else if (parseFloat(this.form.valeurVenale) > parseFloat(this.form.valeurNeuve)) {
        this.errors.valeurVenale = 'La valeur vénale doit être inférieure ou égale à la valeur neuve';
      }
      if (!this.form.marque_id) this.errors.marque_id = 'Ce champ est obligatoire';
      if (!this.form.modele_id) this.errors.modele_id = 'Ce champ est obligatoire';
      if (!this.form.type_motorisation_id) this.errors.type_motorisation_id = 'Ce champ est obligatoire';
      if (!this.formCl.nom) this.errorsCl.nom = 'Ce champ est obligatoire';
      if (!this.formCl.prenom) this.errorsCl.prenom = 'Ce champ est obligatoire';
      if (!this.formCl.email) this.errorsCl.email = 'Ce champ est obligatoire';
      if (!this.formCl.telephone) this.errorsCl.telephone = 'Ce champ est obligatoire';
      if (!this.formCl.ville_id) this.errorsCl.ville_id = 'Ce champ est obligatoire';
      if (!this.formCl.date_naissance) {
        this.errorsCl.date_naissance = 'Ce champ est obligatoire';
      } else if (new Date(this.formCl.date_naissance) > new Date(this.maxBirthDate)) {
        this.errorsCl.date_naissance = 'Vous devez avoir au moins 18 ans';
      }
      return Object.keys(this.errors).length === 0 && Object.keys(this.errorsCl).length === 0;
    },
    submitForm() {
      if (this.validateForm()) {
        axios.post('vehicules', this.form)
          .then(response => {
            alert('Véhicule créé avec succès!');
            // Une fois le véhicule ajouté avec succès, récupérez l'ID client
            axios.post('/clients_form', this.formCl)
              .then(clientResponse => {
                const clientId = clientResponse.data.client.id;
                alert('Client ajouté avec succès!');
                // Ensuite, créez le devis avec l'ID client récupéré
                const devisData = {
                  matricule: this.form.matricule,
                  client_id: clientId,
                  date_debut: this.formDev.dateDebut,
                  // Autres champs de devis si nécessaire
                };
                axios.post('/enregistrer', devisData)
                  .then(devisResponse => {
                    alert('Devis créé avec succès!');
                    this.resetForm();
                  })
                  .catch(error => {
                    console.error('Erreur lors de la création du devis:', error);
                  });
              })
              .catch(error => {
                console.error('Erreur lors de l\'ajout du client:', error);
              });
          })
          .catch(error => {
            console.error('Erreur lors de la création du véhicule:', error);
          });
          this.$router.push('/devis');
      }
    },
    resetForm() {
      this.form = {
        matricule: '',
        puissanceFiscale: '',
        dateMiseEnCirculation: '',
        valeurNeuve: '',
        valeurVenale: '',
        marque_id: '',
        modele_id: '',
        type_motorisation_id: ''
      };
      this.formCl = {
        nom: '',
        prenom: '',
        email: '',
        telephone: '',
        ville_id: '',
        date_naissance:''
      };
      this.errors = {};
      this.errorsCl = {};
    }
  }
};
</script>